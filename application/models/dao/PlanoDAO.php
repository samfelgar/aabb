<?php

require_once 'DAO.php';

class PlanoDAO extends DAO {

    public function inserir(Plano $plano) {
        try {
            $sql = 'insert into planos (descricao, valor) values (?,?)';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $plano->getDescricao(),
                $plano->getValor()
            ));
            if (!$result) {
                throw new Exception('<strong>[INSERIR PLANO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function alterar(Plano $plano) {
        try {
            $sql = 'update planos set descricao = ?, valor = ? where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $plano->getDescricao(),
                $plano->getValor(),
                $plano->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[ALTERAR PLANO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listar() {
        try {
            $sql = 'select * from planos';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute()) {
                throw new PDOException('<strong>[LISTAR PLANOS]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $result = array();
            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->load->model('plano');
                $plano = new Plano();
                $plano->setId($r['id']);
                $plano->setDescricao($r['descricao']);
                $plano->setValor($r['valor']);
                $result[] = $plano;
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete(Plano $plano) {
        try {
            $sql = 'delete from planos where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $plano->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[EXCLUIR PLANO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
