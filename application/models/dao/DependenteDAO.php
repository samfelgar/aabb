<?php

require_once 'DAO.php';

class DependenteDAO extends DAO {

  public function inserir(Dependente $dependente) {
    try {
      $sql = 'insert into dependentes (nome, nascimento, cpf, parentesco, associados_id) values (?,?,?,?,?)';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $dependente->getNome(),
        $dependente->getNascimento(),
        $dependente->getCpf(),
        $dependente->getParentesco(),
        $dependente->getAssociado()->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[INSERIR DEPENDENTE]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function alterar(Dependente $dependente) {
    try {
      $sql = 'update dependentes set nome = ?, nascimento = ?, cpf = ?, parentesco = ? where id = ?';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $dependente->getNome(),
        $dependente->getNascimento(),
        $dependente->getCpf(),
        $dependente->getParentesco(),
        $dependente->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[ALTERAR DEPENDENTE]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function photo(Dependente $dependente) {
    try {
      $sql = 'update dependentes set photo = ? where id = ?';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $dependente->getPhoto(),
        $dependente->getId()
      ));
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function listar(Associado $associado) {
    try {
      $sql = 'select * from dependentes where associados_id = ?';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute(array($associado->getId()))) {
        throw new PDOException('<strong>[LISTAR DEPENDENTE]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
      }
      $result = array();
      while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->load->model('dependente');
        $dependente = new Dependente();
        $dependente->setId($r['id']);
        $dependente->setNome($r['nome']);
        $dependente->setNascimento($r['nascimento']);
        $dependente->setCpf($r['cpf']);
        $dependente->setParentesco($r['parentesco']);
        $dependente->setAssociado($associado);
        $result[] = $dependente;
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function listarPorId(Dependente $dependente) {
    try {
      $sql = 'select * from dependentes where id = ?';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute(array($dependente->getId()))) {
        throw new PDOException('<strong>[LISTAR DEPENDENTE]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
      }
      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      if (empty($r)) {
        throw new Exception('<strong>[LISTAR DEPENDENTE]</strong> Não foram encontrados resultados.');
      }
      $dependente->setNome($r['nome']);
      $dependente->setNascimento($r['nascimento']);
      $dependente->setCpf($r['cpf']);
      $dependente->setParentesco($r['parentesco']);
      $this->load->model('associado');
      $this->associado->setId($r['associados_id']);
      $dependente->setAssociado($this->associado);
      return $dependente;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function listarPorCPF(Dependente $dependente) {
    try {
      $sql = 'select * from dependentes where cpf = ?';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute(array($dependente->getCpf()))) {
        throw new PDOException('<strong>[LISTAR DEPENDENTE]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
      }
      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      $dependente = new Dependente();
      $dependente->setId($r['id']);
      $dependente->setNome($r['nome']);
      $dependente->setNascimento($r['nascimento']);
      $dependente->setCpf($r['cpf']);
      $dependente->setParentesco($r['parentesco']);
      $this->load->model('associado');
      $associado = new Associado();
      $associado->setId($r['associados_id']);
      $dependente->setAssociado($associado);
      return $dependente;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function listarPorNome(Dependente $dependente) {
    try {
      $sql = 'SELECT * FROM dependentes WHERE nome LIKE ?';
      $stm = $this->c->prepare($sql);
      $params = [
        '%' . $dependente->getNome() . '%'
      ];
      if (! $stm->execute($params)) {
        throw new Exception('[DEPENDENTE_POR_NOME] Houve um problema no processamento da sua solicitação.');
      }
      $result = array();
      while ($r = $stm->fetch(PDO::FETCH_ASSOC)) {
        $this->load->model('dependente');
        $this->load->model('associado');
        $dependente = new Dependente();
        $dependente->setId($r['id']);
        $dependente->setNome($r['nome']);
        $dependente->setNascimento($r['nascimento']);
        $dependente->setCpf($r['cpf']);
        $dependente->setParentesco($r['parentesco']);
        $associado = new Associado();
        $associado->setId($r['associados_id']);
        $dependente->setAssociado($associado);
        $result[] = $dependente;
      }
      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function pesquisarCPF($cpf) {
    try {
      $sql = 'SELECT cpf from dependentes WHERE cpf = ?';
      $stm = $this->c->prepare($sql);
      if (!$stm->execute([$cpf])) {
        throw new Exception('<strong>[PESQUISA CPF]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      $r = $stm->fetchAll(PDO::FETCH_ASSOC);
      return count($r);
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function buscarFoto(Dependente $dependente) {
    try {
      $sql = 'select photo from dependentes where id = ?';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute(array($dependente->getId()))) {
        throw new Exception('Não foi possível obter a foto.');
      }
      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      $dependente->setPhoto($r['photo']);
      return $dependente;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function getAssociadoId(Dependente $dependente) {
    try {
      $sql = 'select associados_id from dependentes where id = ?';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute(array($dependente->getId()))) {
        throw new Exception('[OBTER ID ASSOCIADO VINCULADO] Não foi possível completar a transação.');
      }
      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->load->model('associado');
      $this->associado->setId($r['associados_id']);
      $dependente->setAssociado($this->associado);
      return $dependente;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function delete(Dependente $dependente) {
    try {
      $sql = 'delete from dependentes where id = ?';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $dependente->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[EXCLUIR DEPENDENTE]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

}
