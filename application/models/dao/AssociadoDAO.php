<?php

require_once 'DAO.php';

class AssociadoDAO extends DAO {

  public function inserir(Associado $associado) {
    try {
      $sql = 'insert into associados (nome, cpf, rg, nascimento, estado_civil, email, agencia, conta, tipo_conta, data_associacao, '
      . 'forma_pagamento, planos_id) values (?,?,?,?,?,?,?,?,?,?,?,?)';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $associado->getNome(),
        $associado->getCpf(),
        $associado->getRg(),
        $associado->getNascimento(),
        $associado->getEstadoCivil(),
        $associado->getEmail(),
        $associado->getAgencia(),
        $associado->getConta(),
        $associado->getTipoConta(),
        $associado->getDataAssociacao(),
        $associado->getFormaPagamento(),
        $associado->getPlano()->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[INSERIR ASSOCIADO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      return $this->c->lastInsertId();
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function alterar(Associado $associado) {
    try {
      $sql = 'update associados set nome = ?, cpf = ?, rg = ?, nascimento = ?, estado_civil = ?, email = ?, agencia = ?, conta = ?, '
      . ' tipo_conta = ?, data_associacao = ?, forma_pagamento = ?, planos_id = ? where id = ?';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $associado->getNome(),
        $associado->getCpf(),
        $associado->getRg(),
        $associado->getNascimento(),
        $associado->getEstadoCivil(),
        $associado->getEmail(),
        $associado->getAgencia(),
        $associado->getConta(),
        $associado->getTipoConta(),
        $associado->getDataAssociacao(),
        $associado->getFormaPagamento(),
        $associado->getPlano()->getId(),
        $associado->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[ALTERAR ASSOCIADO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function photo(Associado $associado) {
    try {
      $sql = 'update associados set photo = ? where id = ?';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $associado->getPhoto(),
        $associado->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[INSERIR FOTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function listar($status = 1) {
    try {
      $sql = 'select a.id, a.nome, a.cpf, a.rg, a.nascimento, a.estado_civil, a.email, a.agencia, a.conta, a.tipo_conta, a.data_associacao, '
      . 'a.forma_pagamento, a.status, a.planos_id, p.descricao, p.valor from associados a '
      . 'inner join planos p on a.planos_id = p.id '
      . 'where a.status = ? '
      . 'order by a.nome';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute(array($status))) {
        throw new PDOException('<strong>[LISTAR ASSOCIADO]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
      }
      $result = array();
      while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->load->model('associado');
        $this->load->model('plano');
        $associado = new Associado();
        $associado->setId($r['id']);
        $associado->setNome($r['nome']);
        $associado->setCpf($r['cpf']);
        $associado->setRg($r['rg']);
        $associado->setNascimento($r['nascimento']);
        $associado->setEstadoCivil($r['estado_civil']);
        $associado->setEmail($r['email']);
        $associado->setAgencia($r['agencia']);
        $associado->setConta($r['conta']);
        $associado->setTipoConta($r['tipo_conta']);
        $associado->setDataAssociacao($r['data_associacao']);
        $associado->setFormaPagamento($r['forma_pagamento']);
        $associado->setStatus($r['status']);
        $plano = new Plano();
        $plano->setId($r['planos_id']);
        $plano->setDescricao($r['descricao']);
        $plano->setValor($r['valor']);
        $associado->setPlano($plano);
        $result[] = $associado;
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function listarMenos(Associado $associado) {
    try {
      $sql = 'select a.id, a.nome, a.cpf, a.forma_pagamento, p.descricao, p.valor from associados a '
      . 'inner join planos p on a.planos_id = p.id '
      . 'where a.id = ?';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute(array($associado->getId()))) {
        throw new PDOException('<strong>[LISTAR ASSOCIADO]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
      }
      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      $associado->setNome($r['nome']);
      $associado->setCpf($r['cpf']);
      $associado->setFormaPagamento($r['forma_pagamento']);
      $this->load->model('plano');
      $plano = new Plano();
      $plano->setDescricao($r['descricao']);
      $plano->setValor($r['valor']);
      $associado->setPlano($plano);
      return $associado;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function listarPorId(Associado $associado) {
    try {
      $sql = 'select a.*, p.descricao, p.valor from associados a '
      . 'inner join planos p on a.planos_id = p.id '
      . 'where a.id = ?';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute(array($associado->getId()))) {
        throw new PDOException('<strong>[LISTAR ASSOCIADO]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
      }
      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      $associado->setNome($r['nome']);
      $associado->setCpf($r['cpf']);
      $associado->setRg($r['rg']);
      $associado->setNascimento($r['nascimento']);
      $associado->setEstadoCivil($r['estado_civil']);
      $associado->setEmail($r['email']);
      $associado->setAgencia($r['agencia']);
      $associado->setConta($r['conta']);
      $associado->setTipoConta($r['tipo_conta']);
      $associado->setDataAssociacao($r['data_associacao']);
      $associado->setFormaPagamento($r['forma_pagamento']);
      $associado->setStatus($r['status']);
      $associado->setPhoto($r['photo']);
      $this->load->model('plano');
      $plano = new Plano();
      $plano->setId($r['planos_id']);
      $plano->setDescricao($r['descricao']);
      $plano->setValor($r['valor']);
      $associado->setPlano($plano);
      return $associado;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function numeroDeAssociados() {
    try {
      $sql = 'select count(id) as total from associados where status = 1';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute()) {
        throw new Exception('<strong>[NUMERO DE ASSOCIADOS]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['total'];
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function associadosPorPlano() {
    try {
      $sql = 'select count(a.id) as total, p.descricao as plano, p.valor as valor from associados a '
      . 'inner join planos p on a.planos_id = p.id '
      . 'where a.status = 1 '
      . 'group by a.planos_id';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute()) {
        throw new PDOException('<strong>[LISTAR ASSOCIADO]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
      }
      $result = [];
      $this->load->model('plano');
      while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $plano = new Plano();
        $plano->setDescricao($r['plano']);
        $plano->setValor($r['valor']);
        $result[] = array($plano, $r['total']);
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }

  }

  public function delete(Associado $associado) {
    try {
      $sql = 'delete from associados where id = ?';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $associado->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[EXCLUIR ASSOCIADO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function disable(Associado $associado) {
    try {
      $sql = 'update associados set status = 0 where id = ?';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $associado->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[DESABILITAR ASSOCIADO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
    } catch (Exception $ex) {
      throw $ex;
    }
  }

}
