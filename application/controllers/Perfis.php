<?php

class Perfis extends MY_Controller {

    public function index() {
        try {
            $this->load->model('dao/perfilDAO');
            $this->load->template('perfis', [
                'active' => 'sistema',
                'perfis' => $this->perfilDAO->listar()
            ]);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function novo() {
        $this->load->template('novo_perfil', [
            'active' => 'sistema'
        ]);
    }

    public function alterar($id) {
        $this->load->model('perfil');
        $this->load->model('dao/perfilDAO');
        $this->perfil->setId($id);
        $this->load->template('alterar_perfil', [
            'active' => 'sistema',
            'perfil' => $this->perfilDAO->listarPorId($this->perfil)
        ]);
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
            $this->error($e);
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
            $this->error($e);
        }
    }

    private function error(Exception $ex) {
        $data = [
            'active' => 'sistema',
            'error' => $ex->getMessage(),
        ];
        $this->load->template('error', $data);
    }
}