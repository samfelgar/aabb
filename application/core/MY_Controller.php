<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $uri = $this->uri->uri_string();
        if (!$this->verify()) {
            redirect('/login/?continue=' . $uri);
        }
        $this->load->model('user_track');
    }

    private function verify() {
        session_start();
        if (empty($_SESSION['user_id'])) {
            return false;
        } else {
            return true;
        }
    }

    protected function error(Exception $e, $active = 'home') {
        $data = [
            'active' => $active,
            'error' => $e->getMessage(),
        ];
        $this->load->template('error', $data);
    }

}
