<?php

class TaxaAssociado extends CI_Model {
    
    protected $taxa;
    protected $associado;
    protected $valorPago;
    protected $data;
    protected $parcela;
    protected $aberto;
    
    function getTaxa() {
        return $this->taxa;
    }

    function getAssociado() {
        return $this->associado;
    }

    function getValorPago() {
        return $this->valorPago;
    }

    function getData() {
        return $this->data;
    }

    function getParcela() {
        return $this->parcela;
    }

    function getAberto() {
        return $this->aberto;
    }
    
    function setTaxa(Taxa $taxa) {
        $this->taxa = $taxa;
    }

    function setAssociado(Associado $associado) {
        $this->associado = $associado;
    }

    function setValorPago($valorPago) {
        $this->valorPago = $valorPago;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setParcela($parcela) {
        $this->parcela = $parcela;
    }
    
    function setAberto($aberto) {
        $this->aberto = $aberto;
    }

}