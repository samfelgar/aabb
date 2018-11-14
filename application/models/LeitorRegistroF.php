<?php

class LeitorRegistroF extends CI_Model {

	const codigoRetorno = [
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

	public function obterRegistro($line) {
		$this->load->model('registrof', 'f');
		$this->f->setF01(substr($line, 0, 1));
		$this->f->setF02(substr($line, 1, 25));
		$this->f->setF03(substr($line, 26, 4));
		$this->f->setF04(substr($line, 30, 14));
		$this->f->setF05(substr($line, 44, 8));
		$this->f->setF06(substr($line, 52, 15));
		$this->f->setF07(substr($line, 67, 2));
		$this->f->setF08(substr($line, 69, 70));
		$this->f->setF09(substr($line, 139, 10));
		$this->f->setF10(substr($line, 149, 1));
		return $this->f;
	}

}
