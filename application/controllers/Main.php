<?php

class Main extends MY_Controller {

    public function index() {
      $this->load->model('dao/associadoDAO', 'ad');
        $this->load->view('header', array(
            'active' => 'home'
        ));
        $this->load->view('main', array(
          'totalAssociados' => $this->ad->numeroDeAssociados(),
          'associadosPorPlano' => $this->ad->associadosPorPlano()
        ));
        $this->load->view('footer');
    }
}
