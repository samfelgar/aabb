<?php

require_once 'DAO.php';

class PerfilDAO extends DAO {

    public function inserir(Perfil $perfil) {
        try {
            $sql = 'insert into perfis (descricao) values (?)';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $perfil->getDescricao()
            ));
            if (!$result) {
                throw new Exception('<strong>[INSERIR PERFIL]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function alterar(Perfil $perfil) {
        try {
            $sql = 'update perfis set descricao = ? where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $perfil->getDescricao(),
                $perfil->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[ALTERAR PERFIL]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listar() {
        try {
            $sql = 'select * from perfis';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute()) {
                throw new PDOException('<strong>[LISTAR PERFIS]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $result = array();
            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->load->model('perfil');
                $perfil = new Perfil();
                $perfil->setId($r['id']);
                $perfil->setDescricao($r['descricao']);
                $result[] = $perfil;
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete(Perfil $perfil) {
        try {
            $sql = 'delete from perfil where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $perfil->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[EXCLUIR PERFIL]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}