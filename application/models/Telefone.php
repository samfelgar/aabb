<?php

class Telefone extends CI_Model {

    protected $id;
    protected $ddd;
    protected $telefone;
    protected $associado;

    public function getId() {
        return $this->id;
    }

    public function getDdd() {
        return $this->ddd;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getAssociado() {
        return $this->associado;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDdd($ddd) {
        $this->ddd = $ddd;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setAssociado(Associado $associado) {
        $this->associado = $associado;
    }

}
