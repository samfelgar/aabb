<?php

require_once 'DAO.php';

class MenuDAO extends DAO {

    public function inserir(Menu $menu) {
        try {
            $sql = 'insert into menus (descricao, url, menus_id) values (?, ?, ?)';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $menu->getDescricao(),
                $menu->getUrl(),
                (empty($menu->getMenu())) ? null : $menu->getMenu()->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[INSERIR MENU]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function alterar(Menu $menu) {
        try {
            $sql = 'update menus set descricao = ?, url = ?, menus_id = ? where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $menu->getDescricao(),
                $menu->getUrl(),
                (empty($menu->getMenu())) ? null : $menu->getMenu()->getId(),
                $menu->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[ALTERAR MENU]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listar() {
        try {
            $sql = 'select * from menus';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute()) {
                throw new PDOException('<strong>[LISTAR MENUS]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $result = array();
            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->load->model('menu');
                $menu = new Menu();
                $menuPai = new Menu();
                $menu->setId($r['id']);
                $menu->setDescricao($r['descricao']);
                $menu->setUrl($r['url']);
                $menuPai->setId($r['menus_id']);
                $menu->setMenu($menuPai);
                $result[] = $menu;
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listarMenusPai() {
        try {
            $sql = 'select * from menus where menus_id IS NULL';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute()) {
                throw new PDOException('<strong>[LISTAR MENUS PAI]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $result = array();
            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->load->model('menu');
                $menu = new Menu();
                $menu->setId($r['id']);
                $menu->setDescricao($r['descricao']);
                $menu->setUrl($r['url']);
                $result[] = $menu;
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listarPorId(Menu $menu) {
        try {
            $sql = 'select * from menus where id = ?';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute([$menu->getId()])) {
                throw new PDOException('<strong>[LISTAR MENUS POR ID]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->load->model('menu');
            $menu = new Menu();
            $menuPai = new Menu();
            $menu->setId($r['id']);
            $menu->setDescricao($r['descricao']);
            $menu->setUrl($r['url']);
            $menuPai->setId($r['menus_id']);
            $menu->setMenu($menuPai);
            return $menu;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete(Menu $menu) {
        try {
            $sql = 'delete from menus where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $menu->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[EXCLUIR MENU]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}