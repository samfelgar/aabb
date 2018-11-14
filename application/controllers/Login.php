<?php

class Login extends CI_Controller {

  public function index($msg = null) {
    $data = ['alert_display' => 'd-none', 'msg' => $msg];
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
      if (!$result || !password_verify($this->login->getPass(), $result->getPass())) {
        throw new Exception('Usuário ou senha inválidos.');
      }
      session_start();
      $_SESSION['user'] = $this->login->getUser();
      redirect('/');
    } catch (Exception $e) {
      $msg = $e->getMessage();
      $this->index($msg);
    }
  }

}
