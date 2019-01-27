<?php

class Login extends CI_Controller {

    public function index($msg = null) {
        $data = [
            'alert_display' => 'd-none',
            'msg' => $msg,
            'uri' => $this->input->get('continue')
        ];
        if ($msg != null) {
            $data['alert_display'] = '';
        }
        $this->load->view('login', $data);
    }

    public function acessar() {
        try {
            $this->load->model('dao/loginDAO', 'ld');
            $this->load->model('login_class', 'login');
            $this->login->setUser($this->input->post('login'));
            $this->login->setPass($this->input->post('pass'));
            $result = $this->ld->checkUserPass($this->login);
            if (!$result) {
                throw new Exception('Usuário ou senha inválidos.');
            }
            session_start();
            $_SESSION['user_id'] = $result->getId();
            $_SESSION['user'] = $result->getUser();
            $_SESSION['perfil'] = $result->getPerfil()->getId();
            if ($_SESSION['perfil'] == 3) {
                redirect('/portaria');
            } else {
                redirect('/' . $this->input->get('continue'));
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $this->index($msg);
        }
    }

}
