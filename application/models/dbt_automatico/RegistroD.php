<?php

class RegistroD extends CI_Model {

    protected $d01;
    protected $d02;
    protected $d03;
    protected $d04;
    protected $d05;
    protected $d06;
    protected $d07;
    protected $d08;

    public function getD01() {
        return $this->d01;
    }

    public function getD02() {
        return $this->d02;
    }

    public function getD03() {
        return $this->d03;
    }

    public function getD04() {
        return $this->d04;
    }

    public function getD05() {
        return $this->d05;
    }

    public function getD06() {
        return $this->d06;
    }

    public function getD07() {
        return $this->d07;
    }

    public function getD08() {
        return $this->d08;
    }

    public function setD01($d01) {
        $this->d01 = trim($d01);
    }

    public function setD02($d02) {
        $this->d02 = trim($d02);
    }

    public function setD03($d03) {
        $this->d03 = trim($d03);
    }

    public function setD04($d04) {
        $this->d04 = trim($d04);
    }

    public function setD05($d05) {
        $this->d05 = trim($d05);
    }

    public function setD06($d06) {
        $this->d06 = trim($d06);
    }

    public function setD07($d07) {
        $this->d07 = trim($d07);
    }

    public function setD08($d08) {
        $this->d08 = trim($d08);
    }
    
    public function setFromLine($line) {
        if (strlen($line) != 150) {
			return false;
        }
        $this->setD01(substr($line, 0, 1));
        $this->setD02(substr($line, 1, 25));
        $this->setD03(substr($line, 26, 4));
        $this->setD04(substr($line, 30, 14));
        $this->setD05(substr($line, 44, 25));
        $this->setD06(substr($line, 69, 60));
        $this->setD07(substr($line, 129, 20));
        $this->setD08(substr($line, 149, 1));
    }

    public function getLine() {
        $line = '';
        $line .= $this->getD01();
        $line .= str_pad($this->getD02(), 25);
        $line .= str_pad($this->getD03(), 4);
        $line .= str_pad($this->getD04(), 14);
        $line .= str_pad($this->getD05(), 25);
        $line .= str_pad($this->getD06(), 60);
        $line .= str_pad($this->getD07(), 20);
        $line .= $this->getD08();
        return $line;
    }
}