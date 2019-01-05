<?php

class Menus extends MY_Controller {

    private $active = 'sistema';

    public function index() {
        try {
            $this->load->model('menu');
            $this->load->model('dao/menuDAO');
            $this->load->template('menus', [
                'active' => $this->active,
                'links' => $this->menuDAO->listar()
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function novo() {
        try {
            $this->load->model('dao/menuDAO');
            $this->load->template('novo_menu', [
                'active' => $this->active,
                'menusPai' => $this->menuDAO->listarMenusPai()
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function alterar($id) {
        try {
            $this->load->model('dao/menuDAO');
            $this->load->model('menu');
            $this->menu->setId($id);
            $this->load->template('alterar_menu', [
                'active' => $this->active,
                'menusPai' => $this->menuDAO->listarMenusPai(),
                'link' => $this->menuDAO->listarPorId($this->menu)
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function salvar($id = null) {
        try {
            $this->load->model('dao/menuDAO');
            $this->load->model('menu');
            $this->menu->setDescricao($this->input->post('descricao'));
            $this->menu->setUrl($this->input->post('url'));
            $idMenuPai = $this->input->post('menu-pai');
            if (!empty($idMenuPai)) {
                $menuPai = new Menu();
                $menuPai->setId($this->input->post('menu-pai'));
                $this->menu->setMenu($menuPai);
            }
            if (!empty($id)) {
                $this->menu->setId($id);
                $this->menuDAO->alterar($this->menu);
            } else {
                $this->menuDAO->inserir($this->menu);
            }
            redirect('menus');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function excluir($id) {
        try {
            $this->load->model('dao/menuDAO');
            $this->load->model('menu');
            $this->menu->setId($id);
            $this->menuDAO->delete($this->menu);
            redirect('menus');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

}