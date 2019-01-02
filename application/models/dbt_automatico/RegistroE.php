<?php

class RegistroE extends CI_Model {

    protected $e01;
    protected $e02;
    protected $e03;
    protected $e04;
    protected $e05;
    protected $e06;
    protected $e07;
    protected $e08;
    protected $e09;
    protected $e10;

    public function getE01() {
        return $this->e01;
    }

    public function getE02() {
        return $this->e02;
    }

    public function getE03() {
        return $this->e03;
    }

    public function getE04() {
        return $this->e04;
    }

    public function getE05() {
        return $this->e05;
    }

    public function getE06() {
        return $this->e06;
    }

    public function getE07() {
        return $this->e07;
    }

    public function getE08() {
        return $this->e08;
    }

    public function getE09() {
        return $this->e09;
    }

    public function getE10() {
        return $this->e10;
    }

    public function setE01($e01) {
        $this->e01 = trim($e01);
    }

    public function setE02($e02) {
        $this->e02 = trim($e02);
    }

    public function setE03($e03) {
        $this->e03 = trim($e03);
    }

    public function setE04($e04) {
        $this->e04 = trim($e04);
    }

    public function setE05($e05) {
        $this->e05 = trim($e05);
    }

    public function setE06($e06) {
        $this->e06 = trim($e06);
    }

    public function setE07($e07) {
        $this->e07 = trim($e07);
    }

    public function setE08($e08) {
        $this->e08 = trim($e08);
    }

    public function setE09($e09) {
        $this->e09 = trim($e09);
    }

    public function setE10($e10) {
        $this->e10 = trim($e10);
    }

    public function setFromLine($line) {
        if (strlen($line) != 150) {
			return false;
        }
        $this->setE01(substr($line, 0, 1));
        $this->setE02(substr($line, 1, 25));
        $this->setE03(substr($line, 26, 4));
        $this->setE04(substr($line, 30, 14));
        $this->setE05(substr($line, 44, 8));
        $this->setE06(substr($line, 52, 15));
        $this->setE07(substr($line, 67, 2));
        $this->setE08(substr($line, 69, 60));
        $this->setE09(substr($line, 129, 20));
        $this->setE10(substr($line, 149, 1));
    }

    public function getLine() {
        $line = '';
        $line .= $this->getE01();
        $line .= str_pad($this->getE02(), 25);
        $line .= str_pad($this->getE03(), 4);
        $line .= str_pad($this->getE04(), 14);
        $line .= str_pad($this->getE05(), 8, '0', STR_PAD_LEFT);
        $line .= str_pad($this->getE06(), 15, '0', STR_PAD_LEFT);
        $line .= str_pad($this->getE07(), 2, '0', STR_PAD_LEFT);
        $line .= str_pad($this->getE08(), 60);
        $line .= str_pad($this->getE09(), 20);
        $line .= $this->getE10();
        return $line;
    }
    
}