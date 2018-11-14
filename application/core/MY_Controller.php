<?php

class MY_Controller extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if (!$this->verify()) {
      redirect('/login');
    }
  }

  public function verify() {
    session_start();
    if (empty($_SESSION['user'])) {
      return false;
    } else {
      return true;
    }
  }

}
