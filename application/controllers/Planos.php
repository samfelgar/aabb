<?php

class Planos extends MY_Controller {

    public function index() {
        try {
            $this->load->model('dao/planoDAO', 'pd');
            $this->load->template('planos', array(
                'active' => 'planos',
                'planos' => $this->pd->listar()
            ));
        } catch (Exception $ex) {
            $this->error($ex);
        }
    }

    private function error(Exception $ex) {
        $data = [
            'active' => 'planos',
            'error' => $ex->getMessage(),
        ];
        $this->load->template('error', $data);
    }

}
