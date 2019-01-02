<?php

class RegistroH extends CI_Model {

    protected $h01;
    protected $h02;
    protected $h03;
    protected $h04;
    protected $h05;
    protected $h06;
    protected $h07;
    protected $h08;
    
    public function getH01() {
        return $this->h01;
    }

    public function getH02() {
        return $this->h02;
    }

    public function getH03() {
        return $this->h03;
    }

    public function getH04() {
        return $this->h04;
    }

    public function getH05() {
        return $this->h05;
    }

    public function getH06() {
        return $this->h06;
    }

    public function getH07() {
        return $this->h07;
    }

    public function getH08() {
        return $this->h08;
    }

    public function setH01($h01) {
        $this->h01 = trim($h01);
    }

    public function setH02($h02) {
        $this->h02 = trim($h02);
    }

    public function setH03($h03) {
        $this->h03 = trim($h03);
    }

    public function setH04($h04) {
        $this->h04 = trim($h04);
    }

    public function setH05($h05) {
        $this->h05 = trim($h05);
    }

    public function setH06($h06) {
        $this->h06 = trim($h06);
    }

    public function setH07($h07) {
        $this->h07 = trim($h07);
    }

    public function setH08($h08) {
        $this->h08 = trim($h08);
    }

    public function setFromLine($line) {
        if (strlen($line) != 150) {
			return false;
        }
        $this->setH01(substr($line, 0, 1));
        $this->setH02(substr($line, 1, 25));
        $this->setH03(substr($line, 26, 4));
        $this->setH04(substr($line, 30, 14));
        $this->setH05(substr($line, 44, 25));
        $this->setH06(substr($line, 69, 58));
        $this->setH07(substr($line, 127, 22));
        $this->setH08(substr($line, 149, 1));
    }

    public function getLine() {
        $line = '';
        $line .= $this->getH01();
        $line .= str_pad($this->getH02(), 25);
        $line .= str_pad($this->getH03(), 4);
        $line .= str_pad($this->getH04(), 14);
        $line .= str_pad($this->getH05(), 25);
        $line .= str_pad($this->getH06(), 58);
        $line .= str_pad($this->getH07(), 22);
        $line .= $this->getH08();
        return $line;
    }

}