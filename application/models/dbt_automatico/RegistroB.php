<?php

class RegistroB extends CI_Model {

    protected $b01;
    protected $b02;
    protected $b03;
    protected $b04;
    protected $b05;
    protected $b06;
    protected $b07;

    public function getB01() {
        return $this->b01;
    }

    public function getB02() {
        return $this->b02;
    }

    public function getB03() {
        return $this->b03;
    }

    public function getB04() {
        return $this->b04;
    }

    public function getB05() {
        $date = new DateTime($this->b05);
        return $date->format('Ymd');
    }

    public function getB06() {
        return $this->b06;
    }

    public function getB07() {
        return $this->b07;
    }

    public function setB01($b01) {
        $this->b01 = trim($b01);
    }

    public function setB02($b02) {
        $this->b02 = trim($b02);
    }

    public function setB03($b03) {
        $this->b03 = trim($b03);
    }

    public function setB04($b04) {
        $this->b04 = trim($b04);
    }

    public function setB05($b05, $toEn = FALSE) {
        $prop = trim($b05);
        if ($toEn) {
            $date = DateTime::createFromFormat('d/m/Y', $prop);
            $this->b05 = $date->format('Ymd');
        } else {
            $this->b05 = $prop;
        }
    }

    public function setB06($b06) {
        $this->b06 = trim($b06);
    }

    public function setB07($b07) {
        $this->b07 = trim($b07);
    }
    
    public function setFromLine($line) {
        if (strlen($line) != 150) {
			return false;
        }
        $this->setB01(substr($line, 0, 1));
        $this->setB02(substr($line, 1, 25));
        $this->setB03(substr($line, 26, 4));
        $this->setB04(substr($line, 30, 14));
        $this->setB05(substr($line, 44, 8));
        $this->setB06(substr($line, 52, 97));
        $this->setB07(substr($line, 149, 1));
    }

    public function getLine() {
        $line = '';
        $line .= $this->getB01();
        $line .= str_pad($this->getB02(), 25);
        $line .= str_pad($this->getB03(), 4);
        $line .= str_pad($this->getB04(), 14);
        $line .= $this->getB05();
        $line .= str_pad($this->getB06(), 97);
        $line .= $this->getB07();
        return $line;
    }
}