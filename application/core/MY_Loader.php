<?php

class MY_Loader extends CI_Loader {

    public function __construct() {
        parent::__construct();
    }

    public function template($templateName, $vars = [], $return = false) {
        try {
            $this->model('perfil');
            $this->model('dao/perfilMenuDAO');
            $perfil = new Perfil();
            $pm = new PerfilMenuDAO();
            $perfil->setId($_SESSION['perfil']);
            $vars['menus'] = $pm->listarMenusPorPerfil($perfil);
            if ($return) {
                $content = $this->view('header', $vars, $return);
                $content .= $this->view($templateName, $vars, $return);
                $content .= $this->view('footer', $vars, $return);
                return $content;
            } else {
                $this->view('header', $vars, $return);
                $this->view($templateName, $vars, $return);
                $this->view('footer', $vars, $return);
            }
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    private function error(Exception $ex) {
        $data = [
            'active' => 'home',
            'error' => $ex->getMessage(),
        ];
        $this->template('error', $data);
    }
}