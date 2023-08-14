    <?php

require_once("Banco.php");

class MovimentoClientesDAO {

    private $pdo;
    private $debug;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(MovimentoClientes $movimentoclientes) {

        try {
            $sql = "INSERT financeiro_clientes (cod_orcamento, tipo, subtotal, total, descricao, numparcelas, tipopag, categoria, dia, mes, ano, gorjeta, dinheiro, cartaodeb, cartaocred, pix) VALUES (:cod_orcamento, :tipo, :subtotal, :total, :descricao, :numparcelas, :tipopag, :categoria, :dia, :mes, :ano, :gorjeta, :dinheiro, :cartaodeb, :cartaocred, :pix)";

            $param = array(
                ":cod_orcamento" => $movimentoclientes->getCod_orcamento(),
                ":tipo" => $movimentoclientes->getTipo(),
                ":subtotal" => $movimentoclientes->getSubtotal(),
                ":total" => $movimentoclientes->getTotal(),
                ":descricao" => $movimentoclientes->getDescricao(),
                ":numparcelas" => $movimentoclientes->getNumparcelas(),
                ":tipopag" => $movimentoclientes->getTipopag(),
                ":categoria" => $movimentoclientes->getCategoria(),
                ":dia" => $movimentoclientes->getDia(),
                ":mes" => $movimentoclientes->getMes(),
                ":ano" => $movimentoclientes->getAno(),
                ":gorjeta" => $movimentoclientes->getBonus(),
                ":dinheiro" => $movimentoclientes->getDinheiro(),
                ":cartaodeb" => $movimentoclientes->getCartaodeb(),
                ":cartaocred" => $movimentoclientes->getCartaocred(),
                ":pix" => $movimentoclientes->getPix()
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