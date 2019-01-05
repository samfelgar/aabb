<?php

class Acessos extends MY_Controller {

    private $active = 'sistema';

    public function index() {
        try {
            $this->load->model('dao/perfilDAO');
            $this->load->template('selecionar_perfil', [
                'active' => $this->active,
                'perfis' => $this->perfilDAO->listar()
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function visualizar() {
        try {
            $this->load->model('perfil');
            $this->load->model('dao/perfilDAO');
            $this->load->model('dao/perfilMenuDAO', 'pmd');
            $this->perfil->setId($this->input->get('perfil'));
            $this->load->template('visualizar_acessos', [
                'active' => $this->active,
                'perfil' => $this->perfilDAO->listarPorId($this->perfil),
                'menusAtivos' => $this->pmd->listarMenusPorPerfil($this->perfil),
                'menusInativos' => $this->pmd->listarMenusSemAcesso($this->perfil)
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function adicionar() {
        try {
            $this->load->model('perfil');
            $this->load->model('menu');
            $this->load->model('perfilMenu');
            $this->load->model('dao/perfilMenuDAO', 'pmd');
            $this->perfil->setId($this->input->post('perfil'));
            $this->perfilMenu->setPerfil($this->perfil);
            $this->perfilMenu->setMenu($this->menu);
            $menus = $this->input->post('menus');
            foreach ($menus as $menu) {
                $this->menu->setId($menu);
                $this->pmd->inserir($this->perfilMenu);
            }
            redirect('acessos/visualizar/?perfil=' . $this->perfil->getId());
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function remover() {
        try {
            $this->load->model('perfil');
            $this->load->model('menu');
            $this->load->model('perfilMenu');
            $this->load->model('dao/perfilMenuDAO', 'pmd');
            $this->perfil->setId($this->input->post('perfil'));
            $this->perfilMenu->setPerfil($this->perfil);
            $this->perfilMenu->setMenu($this->menu);
            $menus = $this->input->post('menus');
            foreach ($menus as $menu) {
                $this->menu->setId($menu);
                $this->pmd->delete($this->perfilMenu);
            }
            redirect('acessos/visualizar/?perfil=' . $this->perfil->getId());
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

}