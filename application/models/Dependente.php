<?php

class Dependente extends CI_Model {

  protected $id;
  protected $nome;
  protected $nascimento;
  protected $cpf;
  protected $parentesco;
  protected $photo;
  protected $associado;

  public function getId() {
    return $this->id;
  }

  public function getNome() {
    return $this->nome;
  }

  public function getNascimento($format = false) {
    if ($format) {
      $date = new DateTime($this->nascimento);
      return $date->format('d/m/Y');
    }
    return $this->nascimento;
  }

  public function getCpf() {
    return $this->cpf;
  }

  public function getParentesco() {
    return $this->parentesco;
  }

  public function getPhoto($allPath = false) {
    if ($allPath && $this->photo != null) {
      return base_url($this->photo);
    }
    return $this->photo;
  }

  public function getAssociado() {
    return $this->associado;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  /*
  * Caso o $format seja definido como verdadeiro, a data terá o padrão internacional
  * Do contrário, será atribuído ao $this->nascimento a data sem nenhuma formatação
  */
  public function setNascimento($nascimento, $format = false) {
    if ($format) {
      $date = DateTime::createFromFormat('d/m/Y', $nascimento);
      $this->nascimento = $date->format('Y-m-d');
    } else {
      $this->nascimento = $nascimento;
    }
  }

  public function setCpf($cpf) {
    $this->cpf = $cpf;
  }

  public function setParentesco($parentesco) {
    $this->parentesco = $parentesco;
  }

  public function setPhoto($photo) {
    $this->photo = $photo;
  }

  public function setAssociado(Associado $associado) {
    $this->associado = $associado;
  }

}
