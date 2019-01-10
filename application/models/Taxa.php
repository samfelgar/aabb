<?php

class Taxa extends CI_Model {

    protected $id;
    protected $descricao;
    protected $valor;
    protected $parcelas;
    protected $gratuidade;

    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getValor($format = false) {
        if ($format) {
            return number_format($this->valor, 2, ',', '.');
        }
        return $this->valor;
    }

    function getParcelas() {
        return $this->parcelas;
    }

    function getGratuidade() {
        return $this->gratuidade;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setValor($valor, $toEn = false) {
        if ($toEn) {
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
            $this->valor = $valor;
        } else {
            $this->valor = $valor;
        }
    }

    function setParcelas($parcelas) {
        $this->parcelas = $parcelas;
    }

    function setGratuidade($gratuidade) {
        $this->gratuidade = $gratuidade;
    }

}