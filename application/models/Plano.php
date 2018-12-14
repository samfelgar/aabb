<?php

class Plano extends CI_Model {

    protected $id;
    protected $descricao;
    protected $valor;

    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getValor($format = false) {
      if ($format) {
        return number_format($this->valor, 2, ',', '.');
      }
      return $this->valor;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setValor($valor, $toEng = false) {
        if ($toEng) {
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
            $this->valor = $valor;
        } else {
            $this->valor = $valor;
        }
    }

}
