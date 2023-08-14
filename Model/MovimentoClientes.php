<?php

class MovimentoClientes
{

    private $cod;
    private $cod_orcamento;
    private $tipo;
    private $subtotal;
    private $total;
    private $descricao;
    private $numparcelas;
    private $tipopag;
    private $categoria;
    private $dia;
    private $mes;
    private $ano;
    private $gorjeta;
    private $bonus;

    private $dinheiro;
    private $cartaodeb;
    private $cartaocred;
    private $pix;



    function getDinheiro()
    {
        return $this->dinheiro;
    }

    function setDinheiro($dinheiro)
    {
        $this->dinheiro = $dinheiro;
    }


    function getCartaodeb()
    {
        return $this->cartaodeb;
    }

    function setCartapdeb($cartaodeb)
    {
        $this->cartaodeb = $cartaodeb;
    }


    function getCartaocred()
    {
        return $this->cartaocred;
    }

    function setCartaocred($cartaocred)
    {
        $this->cartaocred = $cartaocred;
    }


    function getPix()
    {
        return $this->pix;
    }

    function setPix($pix)
    {
        $this->pix = $pix;
    }

    function getBonus()
    {
        return $this->bonus;
    }

    function setBonus($bonus)
    {
        $this->bonus = $bonus;
    }

    function getCod()
    {
        return $this->cod;
    }

    function getCod_orcamento()
    {
        return $this->cod_orcamento;
    }

    function getTipo()
    {
        return $this->tipo;
    }

    function getSubtotal()
    {
        return $this->subtotal;
    }

    function getTotal()
    {
        return $this->total;
    }

    function getDescricao()
    {
        return $this->descricao;
    }

    function getNumparcelas()
    {
        return $this->numparcelas;
    }

    function getTipopag()
    {
        return $this->tipopag;
    }

    function getCategoria()
    {
        return $this->categoria;
    }

    function getDia()
    {
        return $this->dia;
    }

    function getMes()
    {
        return $this->mes;
    }

    function getAno()
    {
        return $this->ano;
    }

    function getGorjeta()
    {
        return $this->gorjeta;
    }

    function setCod($cod)
    {
        $this->cod = $cod;
    }

    function setCod_orcamento($cod_orcamento)
    {
        $this->cod_orcamento = $cod_orcamento;
    }

    function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    function setTotal($total)
    {
        $this->total = $total;
    }

    function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    function setNumparcelas($numparcelas)
    {
        $this->numparcelas = $numparcelas;
    }

    function setTipopag($tipopag)
    {
        $this->tipopag = $tipopag;
    }

    function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    function setDia($dia)
    {
        $this->dia = $dia;
    }

    function setMes($mes)
    {
        $this->mes = $mes;
    }

    function setAno($ano)
    {
        $this->ano = $ano;
    }

    function setGorjeta($gorjeta)
    {
        $this->gorjeta = $gorjeta;
    }

}
?>