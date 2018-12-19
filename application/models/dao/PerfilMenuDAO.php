<?php

require_once 'DAO.php';

class PerfilMenuDAO extends DAO {

    public function inserir(PerfilMenu $perfilMenu) {
        try {
            $sql = 'insert into perfis_menus (perfis_id, menus_id) values (?, ?)';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $perfilMenu->getPerfil()->getId(),
                $perfilMenu->getMenu()->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[INSERIR PERFIL_MENU]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function alterar(Perfil $perfil, Menu $menu, Perfil $novoPerfil, Menu $novoMenu) {
        try {
            $sql = 'update perfis_menus set perfis_id = ?, menus_id = ? where perfis_id = ? and menus_id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $novoPerfil->getId(),
                $novoMenu->getId(),
                $perfil->getId(),
                $menu->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[ALTERAR PERFIL_MENU]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete(PerfilMenu $perfilMenu) {
        try {
            $sql = 'delete from perfis_menus where perfis_id = ? and menus_id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $perfilMenu->getPerfil()->getId(),
                $perfilMenu->getMenu()->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[EXCLUIR PERFIL_MENU]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listarMenusPorPerfil(Perfil $perfil) {
        try {
            $sql = 'select menus.* from menus '
                . 'inner join perfis_menus on menus.id = perfis_menus.menus_id '
                . 'where perfis_menus.perfis_id = ?';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute([$perfil->getId()])) {
                throw new PDOException('<strong>[LISTAR PERFIS]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $this->load->model('menu');
            $menus = [];
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $r) {
                $menu = new Menu();
                $menu->setId($r['id']);
                $menu->setDescricao($r['descricao']);
                $menu->setUrl($r['url']);
                if (!empty($r['menus_id'])) {
                    $menuPai = new Menu();
                    $menuPai->setId($r['menus_id']);
                    $menu->setMenu($menuPai);
                    $menus[$menuPai->getId()][] = $menu;
                } else {
                    $menus[$menu->getId()][] = $menu;
                }
            }
            return $menus;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listarMenusSemAcesso(Perfil $perfil) {
        try {
            $sql = 'select menus.* from menus'
            . ' inner join perfis_menus on menus.id = perfis_menus.menus_id'
            . ' where perfis_menus.menus_id NOT IN (SELECT perfis_menus.menus_id FROM perfis_menus WHERE perfis_menus.perfis_id = ?)'
            . ' group by menus.id';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute([$perfil->getId()])) {
                throw new PDOException('<strong>[LISTAR PERFIS]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $this->load->model('menu');
            $menus = [];
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $r) {
                $menu = new Menu();
                $menu->setId($r['id']);
                $menu->setDescricao($r['descricao']);
                $menu->setUrl($r['url']);
                if (!empty($r['menus_id'])) {
                    $menuPai = new Menu();
                    $menuPai->setId($r['menus_id']);
                    $menu->setMenu($menuPai);
                    $menus[$menuPai->getId()][] = $menu;
                } else {
                    $menus[$menu->getId()][] = $menu;
                }
            }
            return $menus;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}