<?php

class LeitorRegistroA extends CI_Model {
	
	public function obterRegistro($line) {
		$this->load->model('registroa', 'a');
		$this->a->setA01(substr($line, 0, 1));
		$this->a->setA02(substr($line, 1, 1));
		$this->a->setA03(substr($line, 2, 20));
		$this->a->setA04(substr($line, 22, 20));
		$this->a->setA05(substr($line, 42, 3));
		$this->a->setA06(substr($line, 45, 20));
		$this->a->setA07(substr($line, 65, 8));
		$this->a->setA08(substr($line, 73, 6));
		$this->a->setA09(substr($line, 79, 2));
		$this->a->setA10(substr($line, 81, 17));
		$this->a->setA11(substr($line, 98, 52));
		return $this->a;
	}
}
