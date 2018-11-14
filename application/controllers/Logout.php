<?php

class Logout extends MY_Controller {

  public function index() {
    session_start();
    $_SESSION = array();
    redirect('/login');
  }
}
