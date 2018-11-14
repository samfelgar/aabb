<?php

class Endereco extends CI_Model {

    protected $id;
    protected $logradouro;
    protected $numero;
    protected $bairro;
    protected $complemento;
    protected $cidade;
    protected $estado;
    protected $cep;
    protected $associado;

    public function getId() {
        return $this->id;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCep() {
      return $this->cep;
    }

    public function getAssociado() {
        return $this->associado;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCep($cep) {
      $this->cep = $cep;
    }

    public function setAssociado(Associado $associado) {
        $this->associado = $associado;
    }

}
