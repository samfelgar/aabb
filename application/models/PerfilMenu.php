<?php

class PerfilMenu extends CI_Model {

    protected $perfil;
    protected $menu;

    public function getPerfil() {
        return $this->perfil;
    }

    public function getMenu() {
        return $this->menu;
    }

    public function setPerfil(Perfil $perfil) {
        $this->perfil = $perfil;
    }

    public function setMenu(Menu $menu) {
        $this->menu = $menu;
    }
}