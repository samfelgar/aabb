<?php

class RegistroZ extends CI_Model {

    protected $z01;
    protected $z02;
    protected $z03;
    protected $z04;

    public function getZ01() {
        return $this->z01;
    }

    public function getZ02() {
        return $this->z02;
    }

    public function getZ03() {
        return $this->z03;
    }

    public function getZ04() {
        return $this->z04;
    }

    public function setZ01($z01) {
        $this->z01 = trim($z01);
    }

    public function setZ02($z02) {
        $this->z02 = trim($z02);
    }

    public function setZ03($z03) {
        $this->z03 = trim($z03);
    }

    public function setZ04($z04) {
        $this->z04 = trim($z04);
    }

    public function setFromLine($line) {
        if (strlen($line) != 150) {
			return false;
        }
        $this->setZ01(substr($line, 0, 1));
        $this->setZ02(substr($line, 1, 6));
        $this->setZ03(substr($line, 7, 17));
        $this->setZ04(substr($line, 24, 126));
    }

    public function getLine() {
        $line = '';
        $line .= $this->getZ01();
        $line .= str_pad($this->getZ02(), 6, '0', STR_PAD_LEFT);
        $line .= str_pad($this->getZ03(), 17, '0', STR_PAD_LEFT);
        $line .= str_pad($this->getZ04(), 126);
        return $line;
    }
    
}