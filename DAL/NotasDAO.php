<?php

require_once("Banco.php");

class NotasDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Notas $notas) {
        try {

            $sql = "INSERT INTO `notas` (status, usuario, nomeCli, dia, mes, ano, func, ordem, tipo_pedido, cod_usuarios) VALUES (:status, :usuario, :nomeCli, :dia, :mes, :ano, :func, :ordem, :tipo_pedido, :cod_usuarios)";
            $param = array(
                ":status" => $notas->getStatus(),
                ":usuario" => $notas->getUsuario(),
                ":nomeCli" => $notas->getNomeCli(),
                ":dia" => $notas->getDia(),
                ":mes" => $notas->getMes(),
                ":ano" => $notas->getAno(),
                ":ordem" => $notas->getOrdem(),
                ":tipo_pedido" => $notas->getTipo_entrega(),
                ":func" => $notas->getFunc(),
                ":cod_usuarios" => $notas->getCod_usuarios()
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function Deletar(int $coddeletar) {
        try {

            $sql = "DELETE FROM `notas` WHERE cod = :coddeletar";

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

    public function RetornarNotas(int $tipo, int $id) {
        try {

            $sql = "";
            $param = [];
            switch ($tipo) {
                case 1:
                    $sql = "SELECT * FROM notas WHERE usuario = :cod   ORDER BY cod DESC";
                    $param = array(
                        ":cod" => $id
                    );
                    break;
                case 2:
                    $sql = "SELECT * FROM notas WHERE cod = :cod   ORDER BY cod DESC";
                    $param = array(
                        ":cod" => $id
                    );
                    break;

                case 3:
                    $sql = "SELECT * FROM notas WHERE status=:cod ORDER BY cod ASC  ";
                    $param = array(
                        ":cod" => $id
                    );
                    break;

                case 4:
                    $sql = "SELECT * FROM notas WHERE func=:cod ORDER BY cod ASC  ";
                    $param = array(
                        ":cod" => $id
                    );
                    break;
            }



            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaNotas = [];

            foreach ($dataTable as $resultado) {
                $notas = new Notas();

                $notas->setCod($resultado["cod"]);
                $notas->setStatus($resultado["status"]);
                $notas->setUsuario($resultado["usuario"]);
                $notas->setNomeCli($resultado["nomeCli"]);
                $notas->setDia($resultado["dia"]);
                $notas->setMes($resultado["mes"]);
                $notas->setAno($resultado["ano"]);
                $notas->setFunc($resultado["func"]);



                $listaNotas[] = $notas;
            }

            return $listaNotas;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarNotasDiaMesAno(int $tipo, int $id, int $dia, int $mes, int $ano) {
        try {
            $sql = "";
            $param = [];
            if ($dia == 0) {
                $sql = "SELECT * FROM notas WHERE mes = :mes AND ano = :ano AND status = :status ORDER BY cod ASC";
                $param = array(
                    ":mes" => $mes,
                    ":ano" => $ano,
                    ":status" => 3
                );
            } else {
                switch ($tipo) {
                    case 1:
                        $sql = "SELECT * FROM notas WHERE func = :cod AND dia = :dia AND mes = :mes AND ano = :ano AND status = :status ORDER BY cod ASC";
                        $param = array(
                            ":cod" => $id,
                            ":dia" => $dia,
                            ":mes" => $mes,
                            ":status" => 3,
                            ":ano" => $ano
                        );
                        break;

                    case 2:
                        $sql = "SELECT * FROM notas WHERE dia = :dia AND mes = :mes AND ano = :ano AND status = :status ORDER BY cod ASC";
                        $param = array(
                            ":dia" => $dia,
                            ":mes" => $mes,
                            ":status" => 3,
                            ":ano" => $ano
                        );
                        break;

                    case 3:
                        $sql = "SELECT * FROM notas WHERE mes = :mes AND ano = :ano AND status = :status ORDER BY cod ASC";
                        $param = array(
                            ":mes" => $mes,
                            ":status" => 3,
                            ":ano" => $ano
                        );
                        break;

                    case 4:
                        $sql = "SELECT * FROM notas WHERE ano = :ano AND status = :status ORDER BY cod ASC";
                        $param = array(
                            ":status" => 3,
                            ":ano" => $ano
                        );
                        break;
                      case 5:
                        $sql = "SELECT * FROM notas WHERE func = :cod AND mes = :mes AND ano = :ano AND status = :status ORDER BY cod ASC";
                        $param = array(
                            ":cod" => $id,
                            ":mes" => $mes,
                            ":status" => 3,
                            ":ano" => $ano
                        );
                        break;
                      case 6:
                        $sql = "SELECT * FROM notas WHERE func = :cod  AND ano = :ano AND status = :status ORDER BY cod ASC";
                        $param = array(
                            ":cod" => $id,
                            ":status" => 3,
                            ":ano" => $ano
                        );
                        break;
                }
            }


            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaNotas = [];

            foreach ($dataTable as $resultado) {
                $notas = new Notas();

                $notas->setCod($resultado["cod"]);
                $notas->setStatus($resultado["status"]);
                $notas->setUsuario($resultado["usuario"]);
                $notas->setNomeCli($resultado["nomeCli"]);
                $notas->setDia($resultado["dia"]);
                $notas->setMes($resultado["mes"]);
                $notas->setAno($resultado["ano"]);
                $notas->setFunc($resultado["func"]);



                $listaNotas[] = $notas;
            }

            return $listaNotas;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarNotasDiaMesAnoF(int $tipo, int $id, int $dia, int $mes, int $ano) {
        try {
            $sql = "";
            $param = [];
            switch ($tipo) {
                case 1:
                    $sql = "SELECT * FROM notas WHERE func = :cod AND dia = :dia AND mes = :mes AND ano = :ano AND status = :status ORDER BY cod DESC";
                    $param = array(
                        ":cod" => $id,
                        ":dia" => $dia,
                        ":mes" => $mes,
                        ":status" => 3,
                        ":ano" => $ano
                    );
                    break;

                case 2:
                    $sql = "SELECT * FROM notas WHERE dia = :dia AND mes = :mes AND ano = :ano AND status = :status ORDER BY cod ASC";
                    $param = array(
                        ":dia" => $dia,
                        ":mes" => $mes,
                        ":status" => 3,
                        ":ano" => $ano
                    );
                    break;

                case 3:
                    $sql = "SELECT * FROM notas WHERE mes = :mes AND ano = :ano AND status = :status ORDER BY cod ASC";
                    $param = array(
                        ":mes" => $mes,
                        ":status" => 3,
                        ":ano" => $ano
                    );
                    break;

                case 4:
                    $sql = "SELECT * FROM notas WHERE ano = :ano AND status = :status ORDER BY cod ASC";
                    $param = array(
                        ":status" => 3,
                        ":ano" => $ano
                    );
                    break;
                
                case 5:
                    $sql = "SELECT * FROM notas WHERE func = :cod AND mes = :mes AND ano = :ano AND status = :status ORDER BY cod ASC";
                    $param = array(
                        ":cod" => $id,
                        ":mes" => $mes,
                        ":status" => 3,
                        ":ano" => $ano
                    );
                    break;
            }


            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaNotas = [];

            foreach ($dataTable as $resultado) {
                $notas = new Notas();

                $notas->setCod($resultado["cod"]);
                $notas->setStatus($resultado["status"]);
                $notas->setUsuario($resultado["usuario"]);
                $notas->setNomeCli($resultado["nomeCli"]);
                $notas->setDia($resultado["dia"]);
                $notas->setMes($resultado["mes"]);
                $notas->setAno($resultado["ano"]);
                $notas->setFunc($resultado["func"]);



                $listaNotas[] = $notas;
            }

            return $listaNotas;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarNotasMesAno(int $tipo, int $id, int $mes, int $ano) {
        try {

            $sql = "";
            $param = [];
            switch ($tipo) {
                case 1:
                    $sql = "SELECT * FROM notas WHERE func = :cod AND mes = :mes AND ano = :ano AND status = :status ORDER BY cod ASC";
                    $param = array(
                        ":cod" => $id,
                        ":mes" => $mes,
                        ":status" => 4,
                        ":ano" => $ano
                    );
                    break;
            }



            $dataTable = $this->pdo->ExecuteQuery($sql, $param);

            $listaNotas = [];

            foreach ($dataTable as $resultado) {
                $notas = new Notas();

                $notas->setCod($resultado["cod"]);
                $notas->setStatus($resultado["status"]);
                $notas->setUsuario($resultado["usuario"]);
                $notas->setNomeCli($resultado["nomeCli"]);
                $notas->setDia($resultado["dia"]);
                $notas->setMes($resultado["mes"]);
                $notas->setAno($resultado["ano"]);
                $notas->setFunc($resultado["func"]);



                $listaNotas[] = $notas;
            }

            return $listaNotas;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarUltimaNota(int $codfunc) {
        try {
            $sql = "SELECT * FROM notas WHERE status = 1 AND func = $codfunc ORDER BY COD DESC LIMIT 1";

            $dataTable = $this->pdo->ExecuteQuery($sql);

            $listaNotas = [];

            foreach ($dataTable as $resultado) {
                $notas = new Notas();

                $notas->setCod($resultado["cod"]);
                $notas->setStatus($resultado["status"]);
                $notas->setUsuario($resultado["usuario"]);
                $notas->setNomeCli($resultado["nomeCli"]);
                $notas->setDia($resultado["dia"]);
                $notas->setMes($resultado["mes"]);
                $notas->setAno($resultado["ano"]);
                $notas->setFunc($resultado["func"]);



                $listaNotas[] = $notas;
            }

            return $listaNotas;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function RetornarUltimaNotaFunc($cod) {
        try {
            $sql = "SELECT * FROM notas WHERE status = 1 AND func = $cod ORDER BY COD DESC LIMIT 1";

            $dataTable = $this->pdo->ExecuteQuery($sql);

            $listaNotas = [];

            foreach ($dataTable as $resultado) {
                $notas = new Notas();

                $notas->setCod($resultado["cod"]);
                $notas->setStatus($resultado["status"]);
                $notas->setUsuario($resultado["usuario"]);
                $notas->setNomeCli($resultado["nomeCli"]);
                $notas->setDia($resultado["dia"]);
                $notas->setMes($resultado["mes"]);
                $notas->setAno($resultado["ano"]);
                $notas->setFunc($resultado["func"]);



                $listaNotas[] = $notas;
            }

            return $listaNotas;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function Alterar(Notas $notas) {
        try {
            $sql = "UPDATE notas SET status = :status, usuario = :usuario, nomeCli = :nomeCli dia= :dia, mes = :mes, ano = :ano, func = :func WHERE cod= :cod";
            $param = array(
                ":cod" => $notas->getCod(),
                ":status" => $notas->getStatus(),
                ":usuario" => $notas->getUsuario(),
                ":nomeCli" => $notas->getNomeCli(),
                ":dia" => $notas->getDia(),
                ":mes" => $notas->getMes(),
                ":ano" => $notas->getAno(),
                ":func" => $notas->getFunc(),
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return false;
        }
    }

    public function AlterStatusTodos(int $status, int $id) {
        $sql = "UPDATE notas SET status = :nvStatus WHERE cod = :id";
        $param = array(
            ":nvStatus" => $status,
            ":id" => $id
        );
        return $this->pdo->ExecuteNonQuery($sql, $param);
    }

    public function AlterFunc(int $func, int $cod) {
        $sql = "UPDATE notas SET func = :func WHERE cod = :cod";
        $param = array(
            ":func" => $func,
            ":cod" => $cod
        );
        return $this->pdo->ExecuteNonQuery($sql, $param);
    }

    public function RetornarFunc(int $id) {
        try {

            $sql = "SELECT * FROM notas WHERE cod = :cod  ORDER BY cod ASC";
            $param = array(
                ":cod" => $id
            );

            $dataTable = $this->pdo->ExecuteQuery($sql, $param);
            $codfulano = 0;

            foreach ($dataTable as $resultado) {
                $cod = $resultado["func"];
                $codfulano = $cod;
            }

            return $codfulano;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    public function AlterarNomecli(string $nomecli, int $nota) {
        $sql = "UPDATE notas SET nomeCli = :nome WHERE cod = :cod";
        $param = array(
            ":nome" => $nomecli,
            ":cod" => $nota
        );
        return $this->pdo->ExecuteNonQuery($sql, $param);
    }

	public function RetornarAtraso(int $cod) {
        
        try {
            
            $sql = "SELECT * FROM notas WHERE usuario = :cod  ORDER BY cod DESC LIMIT 1";
            $param = array(
                ":cod" => $cod
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaPontos = [];

            foreach ($dt as $dr) {
                $notas2 = new Notas();

                $notas2->setCod($dr["cod"]);
                $notas2->setUsuario($dr["usuario"]);
                $notas2->setDia($dr["dia"]);
                $notas2->setMes($dr["mes"]);
                $notas2->setAno($dr["ano"]);

                $listaPontos[] = $notas2;
            }

            return $listaPontos;
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }


}
?>