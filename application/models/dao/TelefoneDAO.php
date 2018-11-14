<?php

require_once 'DAO.php';

class TelefoneDAO extends DAO {

    public function inserir(Telefone $telefone) {
        try {
            $sql = 'insert into telefones (ddd, telefone, associados_id) values (?,?,?)';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $telefone->getDdd(),
                $telefone->getTelefone(),
                $telefone->getAssociado()->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[INSERIR TELEFONE]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function alterar(Telefone $telefone) {
        try {
            $sql = 'update telefones set ddd = ?, telefone = ? where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $telefone->getDdd(),
                $telefone->getTelefone(),
                $telefone->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[ALTERAR TELEFONE]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listar(Associado $associado) {
        try {
            $sql = 'select * from telefones where associados_id = ?';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute(array($associado->getId()))) {
                throw new PDOException('<strong>[LISTAR TELEFONE]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $result = array();
            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->load->model('telefone');
                $telefone = new Telefone();
                $telefone->setId($r['id']);
                $telefone->setDdd($r['ddd']);
                $telefone->setTelefone($r['telefone']);
                $telefone->setAssociado($associado);
                $result[] = $telefone;
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listarPorId(Telefone $telefone) {
        try {
            $sql = 'select * from telefones where id = ?';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute(array($telefone->getId()))) {
                throw new PDOException('<strong>[LISTAR TELEFONE]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->load->model('telefone');
            $this->telefone->setId($r['id']);
            $this->telefone->setDdd($r['ddd']);
            $this->telefone->setTelefone($r['telefone']);
            return $this->telefone;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete(Telefone $telefone) {
        try {
            $sql = 'delete from telefones where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $telefone->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[EXCLUIR TELEFONE]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
