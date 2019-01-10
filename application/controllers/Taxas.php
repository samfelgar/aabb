<?php

class Taxas extends MY_Controller {
    
    private $active = 'financeiro';
    
    public function index() {
        try {
            $this->load->model('dao/taxaDAO');
            $this->load->template('financeiro/taxas', [
                'active' => $this->active,
                'taxas' => $this->taxaDAO->listar()
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }
    
    public function nova() {
        $this->load->template('financeiro/nova_taxa', [
            'active' => $this->active
        ]);
    }
    
    public function alterar($id) {
        try {
            $this->load->model('taxa');
            $this->load->model('dao/taxaDAO');
            $this->taxa->setId($id);
            $this->load->template('financeiro/alterar_taxa', [
                'active' => $this->active,
                'taxa' => $this->taxaDAO->listarPorId($this->taxa)
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }
    
    public function excluir($id) {
        try {
            $this->load->model('taxa');
            $this->load->model('dao/taxaDAO');
            $this->taxa->setId($id);
            $this->taxaDAO->excluir($this->taxa);
            redirect('taxas');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }
    
    public function salvar() {
        try {
            $descricao = $this->input->post('descricao');
            $valor = $this->input->post('valor');
            $gratuidade = $this->input->post('gratuidade');
            $parcelas = $this->input->post('parcelas');
            $id = $this->input->post('id');
            $this->load->model('taxa');
            $this->load->model('dao/taxaDAO');
            $this->taxa->setDescricao($descricao);
            $this->taxa->setValor($valor);
            $this->taxa->setGratuidade($gratuidade);
            $this->taxa->setParcelas($parcelas);
            if (empty($id)) {
                $this->taxaDAO->inserir($this->taxa);
            } else {
                $this->taxa->setId($id);
                $this->taxaDAO->alterar($this->taxa);
            }
            redirect('taxas');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }
}
