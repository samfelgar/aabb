<?php

require_once 'DAO.php';

class LancamentoDAO extends DAO {

  public function inserir(Lancamento $lancamento) {
    try {
      $sql = 'insert into lancamentos (data, valor, associados_id) values (?,?,?)';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $lancamento->getData(),
        $lancamento->getValor(),
        $lancamento->getAssociado()->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[INSERIR LANCAMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function excluir(Lancamento $lancamento) {
    try {
      $sql = 'delete from lancamentos where id = ?';
      $stmt = $this->c->prepare($sql);
      $result = $stmt->execute(array(
        $lancamento->getId()
      ));
      if (!$result) {
        throw new Exception('<strong>[EXCLUIR LANCAMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
      }
      return $result;
    } catch (Exception $ex) {
      throw $ex;
    }
  }

  public function porAssociado(Associado $associado) {
    try {
      $sql = 'select * from lancamentos where associados_id = ?';
      $stmt = $this->c->prepare($sql);
      $stmt->execute([
        $associado->getId()
      ]);
      $result = [];
      while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->load->model('lancamento');
        $lancamento = new Lancamento();
        $lancamento->setId($r['id']);
        $lancamento->setData($r['data']);
        $lancamento->setValor($r['valor']);
        $lancamento->setAssociado($associado);
        $result[] = $lancamento;
      }
      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function ultimosLancamentos(Associado $associado, $interval = 12) {
    try {
      $sql = 'select * from lancamentos where data >= date_sub(?, interval ? month) and associados_id = ? '
      . 'order by data desc';
      $stmt = $this->c->prepare($sql);
      $date = new DateTime();
      $date->modify('-1 month');
      $stmt->execute([
        $date->format('Y-m-d'),
        $interval,
        $associado->getId()
      ]);
      $result = [];
      while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->load->model('lancamento');
        $lancamento = new Lancamento();
        $lancamento->setId($r['id']);
        $lancamento->setData($r['data']);
        $lancamento->setValor($r['valor']);
        $lancamento->setAssociado($associado);
        $result[] = $lancamento;
      }
      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function inadimplentes($year, $month) {
    try {
      $sql = "select id from associados "
      . "where id not in (select associados_id from lancamentos where year(data) = ? and month(data) = ?)";
      $stmt = $this->c->prepare($sql);
      $stmt->execute([$year, $month]);
      $this->load->model('associado');
      $result = [];
      while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $associado = new Associado();
        $associado->setId($r['id']);
        $result[] = $associado;
      }
      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function lancamentosPorAno(Associado $associado, $year) {
    try {
      $sql = 'select * from lancamentos where year(data) = ? and associados_id = ? '
      . 'order by data desc';
      $stmt = $this->c->prepare($sql);
      $stmt->execute([
        $year,
        $associado->getId()
      ]);
      $result = [];
      while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $this->load->model('lancamento');
        $lancamento = new Lancamento();
        $lancamento->setId($r['id']);
        $lancamento->setData($r['data']);
        $lancamento->setValor($r['valor']);
        $lancamento->setAssociado($associado);
        $result[] = $lancamento;
      }
      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function check_lancamento(Lancamento $lancamento) {
    try {
      $sql = 'select id from lancamentos where month(data) = ? and year(data) = ? and associados_id = ? '
      . 'order by data desc';
      $stmt = $this->c->prepare($sql);
      $stmt->execute([
        $lancamento->getMonth(),
        $lancamento->getYear(),
        $lancamento->getAssociado()->getId()
      ]);
      $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
      if (count($r) < 1) {
        return false;
      }
      return true;
    } catch (Exception $e) {
      throw $e;
    }
  }

}
