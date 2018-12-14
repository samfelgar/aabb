<?php

class Planos extends MY_Controller {

    public function index() {
        try {
            $this->load->model('dao/planoDAO', 'pd');
            $this->load->template('planos', array(
                'active' => 'planos',
                'planos' => $this->pd->listar()
            ));
        } catch (Exception $ex) {
            $this->error($ex);
        }
    }

    public function novo() {
        $this->load->template('novo_plano', [
            'active' => 'planos'
        ]);
    }

    public function alterar($id) {
        try {
            $this->load->model('plano');
            $this->load->model('dao/planoDAO');
            $this->plano->setId($id);
            $this->load->template('alterar_plano', [
                'active' => 'planos',
                'plano' => $this->planoDAO->listarPorId($this->plano)
            ]);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function salvar($id = null) {
        try {
            $this->load->model('plano');
            $this->load->model('dao/planoDAO');
            $this->plano->setDescricao($this->input->post('descricao'));
            $this->plano->setValor($this->input->post('valor'), true);
            if (empty($id)) {
                $this->planoDAO->inserir($this->plano);
                redirect('planos');
            } else {
                $this->plano->setId($id);
                $this->planoDAO->alterar($this->plano);
                redirect('planos');
            }
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function excluir($id) {
        try {
            $this->load->model('plano');
            $this->load->model('dao/planoDAO');
            $this->plano->setId($id);
            $this->planoDAO->delete($this->plano);
            redirect('planos');
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    private function error(Exception $ex) {
        $data = [
            'active' => 'planos',
            'error' => $ex->getMessage(),
        ];
        $this->load->template('error', $data);
    }

}
