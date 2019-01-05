<?php

class Perfis extends MY_Controller {

    private $active = 'sistema';

    public function index() {
        try {
            $this->load->model('dao/perfilDAO');
            $this->load->template('perfis', [
                'active' => $this->active,
                'perfis' => $this->perfilDAO->listar()
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function novo() {
        $this->load->template('novo_perfil', [
            'active' => $this->active
        ]);
    }

    public function alterar($id) {
        try {
            $this->load->model('perfil');
            $this->load->model('dao/perfilDAO');
            $this->perfil->setId($id);
            $this->load->template('alterar_perfil', [
                'active' => $this->active,
                'perfil' => $this->perfilDAO->listarPorId($this->perfil)
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function salvar($id = null) {
        try {
            $this->load->model('perfil');
            $this->load->model('dao/perfilDAO');
            $this->perfil->setDescricao($this->input->post('descricao'));
            if (empty($id)) {
                $this->perfilDAO->inserir($this->perfil);
            } else {
                $this->perfil->setId($id);
                $this->perfilDAO->alterar($this->perfil);
            }
            redirect('perfis');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function excluir($id) {
        try {
            $this->load->model('perfil');
            $this->load->model('dao/perfilDAO');
            $this->perfil->setId($id);
            $this->perfilDAO->delete($this->perfil);
            redirect('perfis');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

}