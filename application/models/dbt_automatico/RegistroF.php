<?php

class RegistroF extends CI_Model {
	
	const CODIGO_RETORNO = [
		'00' => 'Débito efetuado',
		'01' => 'Insuficiência de fundos',
		'02' => 'Conta corrente não cadastrada',
		'04' => 'Outras restrições',
		'05' => 'Valor do débito excede valor do limite aprovado',
		'10' => 'Agência em regime de encerramento',
		'12' => 'Valor inválido',
		'13' => 'Data de lançamento inválida',
		'14' => 'Agência inválida',
		'15' => 'Conta corrente inválida',
		'18' => 'Data do débito anterior à do processamento',
		'30' => 'Sem contrato de débito automático',
		'31' => 'Débito efetuado em data diferente da informada - feriado na praça de débito',
		'96' => 'Manutenção do cadastro',
		'97' => 'Cancelamento - não encontrado',
		'98' => 'Cancelamento - não efetuado, fora do tempo hábil',
		'99' => 'Cancelamento - cancelado conforme solicitação'
	];
	protected $f01;
	protected $f02;
	protected $f03;
	protected $f04;
	protected $f05;
	protected $f06;
	protected $f07;
	protected $f08;
	protected $f09;
	protected $f10;
	
	public function getF01() {
		return $this->f01;
	}

	public function getF02() {
		return $this->f02;
	}

	public function getF03() {
		return $this->f03;
	}

	public function getF04($format = false) {
		if ($format) {
			return preg_replace('/^0*/', '', $this->f04);
		}
		return $this->f04;
	}

	public function getF05($format = false) {
		if ($format) {
			$data = new DateTime($this->f05);
			return $data->format('d/m/Y');
		}
		return $this->f05;
	}

	public function getF06($format = false) {
		if ($format) {
			return number_format($this->f06, 2, ',', '.');
		}
		return $this->f06;
	}

	public function getF06ToFile() {
		return preg_replace('/[^0-9]/', '', $this->f06);
	}

	public function getF07() {
		return $this->f07;
	}

	public function getF08() {
		return $this->f08;
	}

	public function getF09() {
		return $this->f09;
	}

	public function getF10() {
		return $this->f10;
	}

	public function setF01($f01) {
		$this->f01 = trim($f01);
	}

	public function setF02($f02) {
		$this->f02 = trim($f02);
	}

	public function setF03($f03) {
		$this->f03 = trim($f03);
	}

	public function setF04($f04) {
		$this->f04 = trim($f04);
	}

	public function setF05($f05) {
		$this->f05 = trim($f05);
	}

	public function setF06($f06, $from_file = false) {
		if ($from_file) {
			$tmp = trim($f06);
			$this->f06 = floatval(preg_replace('/(\d{2})$/', '.$0', $tmp));
		} else {
			$this->f06 = trim($f06);
		}
	}

	public function setF07($f07) {
		$this->f07 = trim($f07);
	}

	public function setF08($f08) {
		$this->f08 = trim($f08);
	}

	public function setF09($f09) {
		$this->f09 = trim($f09);
	}

	public function setF10($f10) {
		$this->f10 = trim($f10);
	}

	public function setFromLine($line) {
		if (strlen($line) != 150) {
			return false;
		}
		$this->setF01(substr($line, 0, 1));
		$this->setF02(substr($line, 1, 25));
		$this->setF03(substr($line, 26, 4));
		$this->setF04(substr($line, 30, 14));
		$this->setF05(substr($line, 44, 8));
		$this->setF06(substr($line, 52, 15), true);
		$this->setF07(substr($line, 67, 2));
		$this->setF08(substr($line, 69, 70));
		$this->setF09(substr($line, 139, 10));
		$this->setF10(substr($line, 149, 1));
	}

	public function getLine() {
        $line = '';
        $line .= $this->getF01();
        $line .= str_pad($this->getF02(), 25);
        $line .= str_pad($this->getF03(), 4);
        $line .= str_pad($this->getF04(), 14);
        $line .= str_pad($this->getF05(), 8, '0', STR_PAD_LEFT);
        $line .= str_pad($this->getF06ToFile(), 15, '0', STR_PAD_LEFT);
        $line .= str_pad($this->getF07(), 2);
        $line .= str_pad($this->getF08(), 70);
        $line .= str_pad($this->getF09(), 10);
        $line .= $this->getF10();
        return $line;
    }
}
