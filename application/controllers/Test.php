<?php

class Test extends CI_Controller {

    public function index() {
        $this->load->model('dao/perfilMenuDAO', 'pm');
        $this->load->model('perfil');
        $this->perfil->setId(1);
        print '<pre>';
        print_r($this->pm->listarMenusPorPerfil($this->perfil));
        print '</pre>';
    }
}