<?php

class RegistroC extends CI_Model {

    protected $c01;
    protected $c02;
    protected $c03;
    protected $c04;
    protected $c05;
    protected $c06;
    protected $c07;
    protected $c08;

    public function getC01() {
        return $this->c01;
    }

    public function getC02() {
        return $this->c02;
    }

    public function getC03() {
        return $this->c03;
    }

    public function getC04() {
        return $this->c04;
    }

    public function getC05() {
        return $this->c05;
    }

    public function getC06() {
        return $this->c06;
    }

    public function getC07() {
        return $this->c07;
    }

    public function getC08() {
        return $this->c08;
    }

    public function setC01($c01) {
        $this->c01 = trim($c01);
    }

    public function setC02($c02) {
        $this->c02 = trim($c02);
    }

    public function setC03($c03) {
        $this->c03 = trim($c03);
    }

    public function setC04($c04) {
        $this->c04 = trim($c04);
    }

    public function setC05($c05) {
        $this->c05 = trim($c05);
    }

    public function setC06($c06) {
        $this->c06 = trim($c06);
    }

    public function setC07($c07) {
        $this->c07 = trim($c07);
    }

    public function setC08($c08) {
        $this->c08 = trim($c08);
    }
    
    public function setFromLine($line) {
        if (strlen($line) != 150) {
			return false;
        }
        $this->setC01(substr($line, 0, 1));
        $this->setC02(substr($line, 1, 25));
        $this->setC03(substr($line, 26, 4));
        $this->setC04(substr($line, 30, 14));
        $this->setC05(substr($line, 44, 40));
        $this->setC06(substr($line, 84, 40));
        $this->setC07(substr($line, 124, 25));
        $this->setC08(substr($line, 149, 1));
    }

    public function getLine() {
        $line = '';
        $line .= $this->getC01();
        $line .= str_pad($this->getC02(), 25);
        $line .= str_pad($this->getC03(), 4);
        $line .= str_pad($this->getC04(), 14);
        $line .= str_pad($this->getC05(), 40);
        $line .= str_pad($this->getC06(), 40);
        $line .= str_pad($this->getC07(), 25);
        $line .= $this->getC08();
        return $line;
    }
}