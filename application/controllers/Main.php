<?php

class Main extends MY_Controller {

    public function index() {
        $this->load->model('dao/associadoDAO', 'ad');
        $data = [
            'active' => 'home',
            'totalAssociados' => $this->ad->numeroDeAssociados(),
            'associadosPorPlano' => $this->ad->associadosPorPlano(),
        ];
        $this->load->template('main', $data);
    }
}
