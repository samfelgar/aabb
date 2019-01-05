<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->verify()) {
            redirect('/login');
        }
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
