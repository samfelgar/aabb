<?php

class DAO extends CI_Model {

    protected $c;

    public function __construct() {
        parent::__construct();
        try {
            $this->load->model('dao/factory');
            $this->c = Factory::getConnection();
        } catch (Exception $e) {
            throw $e;
        }
    }

}