<?php

require_once 'DAO.php';

class LoginDAO extends DAO {

    public function checkUserPass(Login_class $login) {
        try {
            $sql = 'select * from login where user = ?';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute([$login->getUser()])) {
                throw new Exception('<strong>[CHECK USER_PASS]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            if ($stmt->rowCount() < 1) {
                return false;
            }
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
            $l = new Login_class();
            $l->setId($r['id']);
            $l->setUser($r['user']);
            $l->setPass($r['pass']);
            $this->load->model('perfil');
            $this->perfil->setId($r['perfis_id']);
            $l->setPerfil($this->perfil);
            if (!$this->check_password($login->getPass(), $l->getPass())) {
                return false;
            }
            return $l;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function inserir(Login_class $login) {
        try {
            $sql = 'INSERT INTO login (user, pass, perfis_id) VALUES (?,?,?)';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $login->getUser(),
                        $login->getPass(),
                        $login->getPerfil()->getId()
                    ])) {
                throw new Exception('[INSERIR USUÁRIO]Não foi possível inserir o usuário.' . $stm->errorInfo()[2]);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function listar() {
        try {
            $sql = 'SELECT l.id, l.user, p.descricao perfil FROM login l'
                    . ' INNER JOIN perfis p ON l.perfis_id = p.id';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute()) {
                throw new Exception('[LISTAR USUÁRIOS] Não foi possível completar esta transação.');
            }
            $result = [];
            $this->load->model('login_class');
            $this->load->model('perfil');
            while ($r = $stm->fetch(PDO::FETCH_ASSOC)) {
                $login = new Login_class();
                $login->setId($r['id']);
                $login->setUser($r['user']);
                $perfil = new Perfil();
                $perfil->setDescricao($r['perfil']);
                $login->setPerfil($perfil);
                $result[] = $login;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function listarPorId(Login_class $login) {
        try {
            $sql = 'SELECT l.id, l.user, p.id perfil_id, p.descricao perfil_descricao FROM login l'
                    . ' INNER JOIN perfis p ON l.perfis_id = p.id'
                    . ' WHERE l.id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $login->getId()
                    ])) {
                throw new Exception('[LISTAR USUÁRIOS] Não foi possível completar esta transação.' . $stm->errorInfo()[2]);
            }
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 1) {
                throw new Exception('A consulta retornou mais de um resultado.');
            }
            $this->load->model('login_class');
            $this->load->model('perfil');
            $login = new Login_class();
            $login->setId($result[0]['id']);
            $login->setUser($result[0]['user']);
            $perfil = new Perfil();
            $perfil->setId($result[0]['perfil_id']);
            $perfil->setDescricao($result[0]['perfil_descricao']);
            $login->setPerfil($perfil);
            return $login;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function alterarPerfil(Login_class $login) {
        try {
            $sql = 'UPDATE login SET perfis_id = ? WHERE id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $login->getPerfil()->getId(),
                        $login->getId()
                    ])) {
                throw new Exception('[ALTERAR PERFIL USUÁRIO] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(Login_class $login) {
        try {
            $sql = 'DELETE FROM login WHERE id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $login->getId()
                    ])) {
                throw new Exception('[EXCLUIR USUÁRIO] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updatePassword(Login_class $login) {
        try {
            $sql = 'UPDATE login SET pass = ? WHERE id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $login->getPass(),
                        $login->getId()
                    ])) {
                throw new Exception('[UPDATE PASSWORD] Não foi possível alterar a senha.');
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function check_password($subject, $stored) {
        return password_verify($subject, $stored);
    }

}
