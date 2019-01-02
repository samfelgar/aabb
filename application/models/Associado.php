<?php

class Associado extends CI_Model {

  protected $id;
  protected $nome;
  protected $cpf;
  protected $rg;
  protected $nascimento;
  protected $estadoCivil;
  protected $email;
  protected $agencia;
  protected $conta;
  protected $tipoConta;
  protected $dataAssociacao;
  protected $formaPagamento;
  protected $status;
  protected $photo;
  protected $plano;

  public function getId() {
    return $this->id;
  }

  public function getNome() {
    return $this->nome;
  }

  public function getCpf() {
    return $this->cpf;
  }

  public function getRg() {
    return $this->rg;
  }

  public function getNascimento($format = false) {
    if ($format) {
      $date = new DateTime($this->nascimento);
      return $date->format('d/m/Y');
    }
    return $this->nascimento;
  }

  public function getEstadoCivil() {
    return $this->estadoCivil;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getAgencia() {
    return $this->agencia;
  }

  public function getConta() {
    return $this->conta;
  }

  public function getTipoConta() {
    return $this->tipoConta;
  }

  public function getDataAssociacao($format = false) {
    if ($format) {
      $date = new DateTime($this->dataAssociacao);
      return $date->format('d/m/Y');
    }
    return $this->dataAssociacao;
  }

  public function getFormaPagamento() {
    return $this->formaPagamento;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getPhoto($allPath = false) {
    if ($allPath && $this->photo != null) {
      return base_url($this->photo);
    }
    return $this->photo;
  }

  public function getPlano() {
    return $this->plano;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }

  public function setCpf($cpf) {
    $this->cpf = $cpf;
  }

  public function setRg($rg) {
    $this->rg = $rg;
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

  public function setEstadoCivil($estadoCivil) {
    $this->estadoCivil = $estadoCivil;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setAgencia($agencia) {
    $this->agencia = preg_replace('/^([0]*\.?[0]*)*([1-9][0-9]*)/', '$2', $agencia);
  }

  public function setConta($conta) {
    $this->conta = preg_replace('/^([0]*\.?[0]*)*([1-9][0-9]*)/', '$2', $conta);
  }

  public function setTipoConta($tipoConta) {
    $this->tipoConta = $tipoConta;
  }

  public function setDataAssociacao($dataAssociacao, $format = false) {
    if ($format) {
      $date = DateTime::createFromFormat('d/m/Y', $dataAssociacao);
      $this->dataAssociacao = $date->format('Y-m-d');
    } else {
      $this->dataAssociacao = $dataAssociacao;
    }
  }

  public function setFormaPagamento($formaPagamento) {
    $this->formaPagamento = $formaPagamento;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function setPhoto($photo) {
    $this->photo = $photo;
  }

  public function setPlano(Plano $plano) {
    $this->plano = $plano;
  }

}
