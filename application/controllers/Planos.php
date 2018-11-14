<?php

class Planos extends MY_Controller {

    public function index() {
        try {
            $this->load->model('dao/planoDAO', 'pd');
            $this->load->view('header', array(
                'active' => 'planos'
            ));
            $this->load->view('planos', array(
                'planos' => $this->pd->listar()
            ));
            $this->load->view('footer');
        } catch (Exception $ex) {
            $this->error($ex);
        }
    }

    private function error(Exception $ex) {
        $this->load->view('header', array(
            'active' => 'planos'
        ));
        $this->load->view('error', array(
            'error' => $ex->getMessage()
        ));
        $this->load->view('footer');
    }

}
