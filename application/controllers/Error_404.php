<?php

class Error_404 extends MY_Controller {

    public function index() {
        $this->output->set_status_header(404);
        $this->load->template('error_404', [
            'active' => ''
        ]);
    }

}
