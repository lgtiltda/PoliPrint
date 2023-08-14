<?php

require_once("Banco.php");

class UsuarioDAO
{

    private $pdo;
    private $debug;

    public function __construct()
    {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Usuarios $usuarios)
    {
        try {

            $sql = "INSERT INTO `usuarios` (nome, usuario, cpf, email, foto, permissao, rua, bairro, numero, celular, senha, status, data_vencimento, sub_usuario) VALUES (:nome, :usuario, :cpf, :email, :foto, :permissao, :rua, :bairro, :numero, :celular, :senha, :status , :data_vencimento, :sub_usuario)";
            $param = array(
                ":nome" => $usuarios->getNome(),
                ":usuario" => $usuarios->getUsuario(),
                ":cpf" => $usuarios->getCpf(),
                ":email" => $usuarios->getEmail(),
                ":foto" => $usuarios->getFoto(),
                ":permissao" => $usuarios->getPermissao(),
                ":rua" => $usuarios->getRua(),
                ":bairro" => $usuarios->getBairro(),
                ":numero" => $usuarios->getNumero(),
                ":celular" => $usuarios->getCelular(),
                ":status" => 1,
                ":data_vencimento" => date('d/M/Y'),
                ":sub_usuario" => $_SESSION['codF'],
                ":senha" => $usuarios->getSenha(),
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function RetornarUsuarios(string $termo, int $tipo, int $status)
    {
        try {
            $sql = "";
            $param = [];
            switch ($tipo) {
                case 1:
                    $sql = "SELECT * FROM usuarios WHERE nome LIKE :termo ORDER BY cod ASC";
                    $param = array(
                        ":termo" => "%{$termo}%"
                    );
                    break;
                case 2:
                    $sql = "SELECT * FROM usuarios WHERE cod = :cod ORDER BY cod DESC";
                    $param = array(
                        ":cod" => $status
                    );
                    break;
                case 3:
                    $sql = "SELECT * FROM usuarios WHERE nome LIKE :termo AND permissao= :permissao ORDER BY cod DESC";
                    $param = array(
                        ":termo" => "%{$termo}%",
                        ":permissao" => $status
                    );
                    break;
                case 4:
                    $sql = "SELECT * FROM usuarios WHERE permissao= :permissao ORDER BY cod DESC";
                    $param = array(
                        ":permissao" => $status
                    );
                    break;
                case 5:
                    $sql = "SELECT * FROM usuarios WHERE permissao= :permissao ORDER BY cod DESC LIMIT 1";
                    $param = array(
                        ":permissao" => $status
                    );
                    break;

            }

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaUsuarios = [];

            foreach ($dataTable as $resultado) {
                $usuarios = new Usuarios();

                $usuarios->setCod($resultado["cod"]);
                $usuarios->setNome($resultado["nome"]);
                $usuarios->setUsuario($resultado["usuario"]);
                $usuarios->setRg(($resultado["rg"]));
                $usuarios->setCpf(($resultado["cpf"]));
                $usuarios->setEmail(($resultado["email"]));
                $usuarios->setFoto($resultado["foto"]);
                $usuarios->setPermissao($resultado["permissao"]);
                $usuarios->setRua(($resultado["rua"]));
                $usuarios->setBairro($resultado["bairro"]);
                $usuarios->setNumero(($resultado["numero"]));
                $usuarios->setCelular(($resultado["celular"]));
                $usuarios->setSenha(($resultado["senha"]));
                $usuarios->setComissao(($resultado["comissao"]));

                $listaUsuarios[] = $usuarios;
            }

            return $listaUsuarios;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function Alterar(Usuarios $usuarios)
    {
        try {
            $sql = "UPDATE usuarios SET nome = :nome, usuario = :usuario, cpf= :cpf, email = :email, permissao = :permissao,  rua = :rua, bairro= :bairro, numero= :numero, celular= :celular, senha = :senha  WHERE cod= :cod";
            $param = array(
                ":nome" => $usuarios->getNome(),
                ":usuario" => $usuarios->getUsuario(),
                ":cpf" => $usuarios->getCpf(),
                ":email" => $usuarios->getEmail(),
                ":permissao" => $usuarios->getPermissao(),
                ":rua" => $usuarios->getRua(),
                ":bairro" => $usuarios->getBairro(),
                ":numero" => $usuarios->getNumero(),
                ":celular" => $usuarios->getCelular(),
                ":senha" => $usuarios->getSenha(),
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);

        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function Deletar2(int $coddeletar)
    {
        try {

            $sql = "DELETE FROM `usuarios` WHERE cod = :coddeletar";

            $param = array(
                ":coddeletar" => $coddeletar
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function AutenticarUsuario(string $usu, string $senha, int $permissao)
    {
        try {
            $sql = "SELECT cod, nome, permissao, foto FROM usuarios WHERE usuario = :usuario AND senha = :senha";
            $param = array(
                ":usuario" => $usu,
                ":senha" => $senha
            );
            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            foreach ($dataTable as $dt) {

                if ($dt != null) {
                    $usuarios = new Usuarios();
                    $usuarios->setCod($dt["cod"]);
                    $usuarios->setNome($dt["nome"]);
                    $usuarios->setPermissao($dt["permissao"]);
                    $usuarios->setFoto($dt["foto"]);

                    return $usuarios;
                } else {
                    return null;
                }
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarNomeUsuarios(int $id)
    {
        try {

            $sql = "SELECT * FROM usuarios WHERE cod = :cod  ORDER BY cod ASC";
            $param = array(
                ":cod" => $id
            );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);
            $nomefulano = "";

            foreach ($dataTable as $resultado) {
                $nome = $resultado["nome"];

                $nomefulano = $nome;
            }

            return $nomefulano;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

}
?>