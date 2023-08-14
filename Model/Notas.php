
<?php

class Notas {

    private $cod;
    private $status;
    private $usuario;
    private $nomeCli;
    private $dia;
    private $mes;
    private $ano;
    private $func;
    private $ordem;
    private $tipo_entrega;

    private $cod_usuarios;

    
    public function getCod_usuarios() {
        return $this->cod_usuarios;
    }

    public function setCod_usuarios($cod_usuarios) {
        $this->cod_usuarios = $cod_usuarios;
    }

    public function getTipo_entrega() {
        return $this->tipo_entrega;
    }

    public function setTipo_entrega($tipo_entrega) {
        $this->tipo_entrega = $tipo_entrega;
    }

    public function getOrdem() {
        return $this->ordem;
    }

    public function setOrdem($ordem) {
        $this->ordem = $ordem;
    }

         
    function getNomeCli() {
        return $this->nomeCli;
    }

    function setNomeCli($nomeCli) {
        $this->nomeCli = $nomeCli;
    }
    
    function getFunc() {
        return $this->func;
    }

    function setFunc($func) {
        $this->func = $func;
    }

    
    
    function getCod() {
        return $this->cod;
    }

    function getStatus() {
        return $this->status;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getDia() {
        return $this->dia;
    }

    function getMes() {
        return $this->mes;
    }

    function getAno() {
        return $this->ano;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setDia($dia) {
        $this->dia = $dia;
    }

    function setMes($mes) {
        $this->mes = $mes;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }



}
?>






