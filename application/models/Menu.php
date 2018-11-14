<?php

class Menu extends CI_Model {

  protected $id;
  protected $descricao;
  protected $url;
  protected $menu;

  public function getId() {
    return $this->id;
  }

  public function getDescricao() {
    return $this->descricao;
  }

  public function getUrl() {
    return $this->url;
  }

  public function getMenu() {
    return $this->menu;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function setDescricao($descricao) {
    $this->descricao = $descricao;
  }

  public function setUrl($url) {
    $this->url = $url;
  }

  public function setMenu(Menu $menu) {
    $this->menu = $menu;
  }
  
}
