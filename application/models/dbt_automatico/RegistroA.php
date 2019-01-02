<?php

class RegistroA extends CI_Model {

	protected $a01;
	protected $a02;
	protected $a03;
	protected $a04;
	protected $a05;
	protected $a06;
	protected $a07;
	protected $a08;
	protected $a09;
	protected $a10;
	protected $a11;

	public function getA01() {
		return $this->a01;
	}

	public function getA02() {
		return $this->a02;
	}

	public function getA03() {
		return $this->a03;
	}

	public function getA04() {
		return $this->a04;
	}

	public function getA05() {
		return $this->a05;
	}

	public function getA06() {
		return $this->a06;
	}

	public function getA07() {
		$date = new DateTime($this->a07);
		return $date->format('Ymd');
	}

	public function getA08() {
		return $this->a08;
	}

	public function getA09() {
		return $this->a09;
	}

	public function getA10() {
		return $this->a10;
	}

	public function getA11() {
		return $this->a11;
	}

	public function setA01($a01) {
		$this->a01 = trim($a01);
	}

	public function setA02($a02) {
		$this->a02 = trim($a02);
	}

	public function setA03($a03) {
		$this->a03 = trim($a03);
	}

	public function setA04($a04) {
		$this->a04 = trim($a04);
	}

	public function setA05($a05) {
		$this->a05 = trim($a05);
	}

	public function setA06($a06) {
		$this->a06 = trim($a06);
	}

	public function setA07($a07, $toEn = FALSE) {
		$prop = trim($a07);
		if ($toEn) {
			$date = DateTime::createFromFormat('d/m/Y', $a07);
			$this->a07 = $date->format('Ymd');
		} else {
			$this->a07 = $prop;
		}
	}

	public function setA08($a08) {
		$this->a08 = trim($a08);
	}

	public function setA09($a09) {
		$this->a09 = trim($a09);
	}

	public function setA10($a10) {
		$this->a10 = trim($a10);
	}

	public function setA11($a11) {
		$this->a11 = trim($a11);
	}

	public function setFromLine($line) {
		if (strlen($line) != 150) {
			return false;
		}
		$this->setA01(substr($line, 0, 1));
		$this->setA02(substr($line, 1, 1));
		$this->setA03(substr($line, 2, 20));
		$this->setA04(substr($line, 22, 20));
		$this->setA05(substr($line, 42, 3));
		$this->setA06(substr($line, 45, 20));
		$this->setA07(substr($line, 65, 8));
		$this->setA08(substr($line, 73, 6));
		$this->setA09(substr($line, 79, 2));
		$this->setA10(substr($line, 81, 17));
		$this->setA11(substr($line, 98, 52));
	}

	public function getLine() {
		$line = '';
		$line .= $this->getA01();
		$line .= $this->getA02();
		$line .= str_pad($this->getA03(), 20);
		$line .= str_pad($this->getA04(), 20);
		$line .= str_pad($this->getA05(), 3, '0', STR_PAD_LEFT);
		$line .= str_pad($this->getA06(), 20);
		$line .= $this->getA07();
		$line .= str_pad($this->getA08(), 6, '0', STR_PAD_LEFT);
		$line .= str_pad($this->getA09(), 2, '0', STR_PAD_LEFT);
		$line .= str_pad($this->getA10(), 17);
		$line .= str_pad($this->getA11(), 52);
		return $line;
	}

}
