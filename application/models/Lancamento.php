<?php

class Lancamento extends CI_Model {

  protected $id;
  protected $data;
  protected $valor;
  protected $associado;
  const MONTHS = [
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro'
  ];

  public function getId() {
    return $this->id;
  }

  public function getData() {
    return $this->data;
  }

  public function getMonth() {
    $date = new DateTime($this->data);
    return $date->format('m');
  }

  public function getYear() {
    $date = new DateTime($this->data);
    return $date->format('o');
  }

  public function getValor() {
    return $this->valor;
  }

  public function getAssociado() {
    return $this->associado;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function setValor($valor) {
    $this->valor = $valor;
  }

  public function setAssociado(Associado $associado) {
    $this->associado = $associado;
  }

}
