<?php

require_once("Banco.php");

class PedidosDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Pedidos $pedidos) {
        try {

            $sql = "INSERT INTO `pedidos` (dente, servico, usuario, qtd, valor, status, nivel, obs, tipo, dia, mes, ano, categoria) VALUES (:dente, :servico, :usuario, :qtd,  :valor, :status, :nivel, :obs, :tipo, :dia, :mes, :ano, :categoria)";
            $param = array(
                ":dente" => $pedidos->getDente(),
                ":servico" => $pedidos->getServico(),
                ":usuario" => $pedidos->getUsuario(),
                ":qtd" => $pedidos->getQtd(),
                ":valor" => $pedidos->getValor(),
                ":status" => $pedidos->getStatus(),
                ":nivel" => $pedidos->getNivel(),
                ":obs" => $pedidos->getObs(),
                ":tipo" => $pedidos->getTipo(),
                ":dia" => $pedidos->getDia(),
                ":mes" => $pedidos->getMes(),
                ":ano" => $pedidos->getAno(),
                ":categoria" => $pedidos->getCategoria(),
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function RetornarPedidos(string $termo, int $tipo, int $status) {
        try {
            $sql = "";
            $param = [];
            switch ($tipo) {
                case 1:
                    $sql = "SELECT * FROM pedidos WHERE usuario= :orcamento ORDER BY nivel DESC";
                    $param = array(
                        ":orcamento" => $status
                    );
                    break;
                case 2:
                    $sql = "SELECT * FROM pedidos WHERE id = :id ORDER BY data DESC";
                    $param = array(
                        ":id" => $status
                    );
                    break;
            }



            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaPedidos = [];

            foreach ($dataTable as $resultado) {
                $pedidos = new Pedidos();

                $pedidos->setCod($resultado["cod"]);
                $pedidos->setDente($resultado["dente"]);
                $pedidos->setServico($resultado["servico"]);
                $pedidos->setUsuario($resultado["usuario"]);
                $pedidos->setQtd($resultado["qtd"]);
                $pedidos->setValor($resultado["valor"]);
                $pedidos->setStatus($resultado["status"]);
                $pedidos->setNivel($resultado["nivel"]);
                $pedidos->setObs($resultado["obs"]);
                $pedidos->setTipo($resultado["tipo"]);
                $pedidos->setDia($resultado["dia"]);
                $pedidos->setMes($resultado["mes"]);
                $pedidos->setAno($resultado["ano"]);
                $pedidos->setCategoria($resultado["categoria"]);


                $listaPedidos[] = $pedidos;
            }

            return $listaPedidos;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarPedidosMesDiaCat(int $categoria, int $dia, int $mes, int $ano) {
        try {

            $sql = "SELECT * FROM pedidos WHERE status = 3 AND dia = :dia AND mes= :mes AND ano=:ano AND categoria = :categoria  ORDER BY cod ASC";
            $param = array(
                ":categoria" => $categoria,
                ":dia" => $dia,
                ":mes" => $mes,
                ":ano" => $ano
            );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaPedidos = [];

            foreach ($dataTable as $resultado) {
                $pedidos = new Pedidos();

                $pedidos->setCod($resultado["cod"]);
                $pedidos->setDente($resultado["dente"]);
                $pedidos->setServico($resultado["servico"]);
                $pedidos->setUsuario($resultado["usuario"]);
                $pedidos->setQtd($resultado["qtd"]);
                $pedidos->setValor($resultado["valor"]);
                $pedidos->setStatus($resultado["status"]);
                $pedidos->setNivel($resultado["nivel"]);
                $pedidos->setObs($resultado["obs"]);
                $pedidos->setTipo($resultado["tipo"]);
                $pedidos->setDia($resultado["dia"]);
                $pedidos->setMes($resultado["mes"]);
                $pedidos->setAno($resultado["ano"]);
                $pedidos->setCategoria($resultado["categoria"]);


                $listaPedidos[] = $pedidos;
            }

            return $listaPedidos;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarPedidosMesCat(int $categoria, int $mes, int $ano) {
        try {
            echo $categoria;
            $sql = "SELECT * FROM pedidos WHERE mes= :mes AND ano=:ano AND categoria = :categoria  ORDER BY cod ASC";
            $param = array(
                ":categoria" => $categoria,
                ":mes" => $mes,
                ":ano" => $ano
            );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaPedidos = [];

            foreach ($dataTable as $resultado) {
                $pedidos = new Pedidos();

                $pedidos->setCod($resultado["cod"]);
                $pedidos->setDente($resultado["dente"]);
                $pedidos->setServico($resultado["servico"]);
                $pedidos->setUsuario($resultado["usuario"]);
                $pedidos->setQtd($resultado["qtd"]);
                $pedidos->setValor($resultado["valor"]);
                $pedidos->setStatus($resultado["status"]);
                $pedidos->setNivel($resultado["nivel"]);
                $pedidos->setObs($resultado["obs"]);
                $pedidos->setTipo($resultado["tipo"]);
                $pedidos->setDia($resultado["dia"]);
                $pedidos->setMes($resultado["mes"]);
                $pedidos->setAno($resultado["ano"]);
                $pedidos->setCategoria($resultado["categoria"]);


                $listaPedidos[] = $pedidos;
            }

            return $listaPedidos;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function Deletar2(int $coddeletar) {
        try {

            $sql = "DELETE FROM `pedidos` WHERE cod = :coddeletar";

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

    public function DeletarO(int $coddeletar) {
        try {

            $sql = "DELETE FROM `pedidos` WHERE usuario = :coddeletar";

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

    public function AlterStatusTodos2(int $status, int $id) {
        $sql = "UPDATE pedidos SET status = :nvStatus WHERE usuario = :id";
        $param = array(
            ":nvStatus" => $status,
            ":id" => $id
        );
        return $this->pdo->ExecuteNonQuery($sql, $param);
    }

    public function AlterStatusCancelar(int $status, int $id) {
        $sql = "UPDATE pedidos SET status = :nvStatus WHERE usuario = :id";
        $param = array(
            ":nvStatus" => $status,
            ":id" => $id
        );
        return $this->pdo->ExecuteNonQuery($sql, $param);
    }

    public function AlterQtdValor(int $qtd, string $valor, int $id) {
        $sql = "UPDATE pedidos SET qtd= :qtd, valor= :valor WHERE cod = :id";
        $param = array(
            ":qtd" => $qtd,
            ":valor" => $valor,
            ":id" => $id
        );
        return $this->pdo->ExecuteNonQuery($sql, $param);
    }

    public function Alterar(Pedidos $pedidos) {
        try {
            $sql = "UPDATE pedidos SET dente = :dente, servico = :servico, usuario=:usuario, qtd=:qtd, valor= :valor, status = :status, nivel = :nivel, obs= :obs, tipo= :tipo, data = :data, categoria= :categoria  WHERE cod= :cod";
            $param = array(
                ":cod" => $pedidos->getCod(),
                ":dente" => $pedidos->getDente(),
                ":servico" => $pedidos->getServico(),
                ":usuario" => $pedidos->getUsuario(),
                ":qtd" => $pedidos->getQtd(),
                ":valor" => $pedidos->getValor(),
                ":status" => $pedidos->getStatus(),
                ":nivel" => $pedidos->getNivel(),
                ":obs" => $pedidos->getObs(),
                ":tipo" => $pedidos->getTipo(),
                ":data" => $pedidos->getData(),
                ":categoria" => $pedidos->getCategoria()
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

}
?>