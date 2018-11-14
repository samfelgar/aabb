<?php

class Perfil extends CI_Model {

  protected $id;
  protected $descricao;

  public function getId() {
    return $this->id;
  }

  public function getDescricao() {
    return $this->descricao;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setDescricao($descricao) {
    $this->descricao = $descricao;
  }
  
}
