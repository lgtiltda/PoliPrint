<?php

if (file_exists("../DAL/MovimentoClientesDAO.php")) {
    require_once("../DAL/MovimentoClientesDAO.php");
} elseif (file_exists("DAL/MovimentoClientesDAO.php")) {
    require_once("DAL/MovimentoClientesDAO.php");
}

class MovimentoClientesController {

    private $movimentoClientesDAO;

    function __construct() {
        $this->movimentoClientesDAO = new MovimentoClientesDAO();
    }

    public function Cadastrar(MovimentoClientes $movimentoclientes) {
        if (1 == 1) {

            return $this->movimentoClientesDAO->Cadastrar($movimentoclientes);
        } else {
            return false;
        }
    }
}
?>