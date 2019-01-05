<?php

class Telefones extends MY_Controller {

    private $active = 'associados';

    public function novo() {
        $this->load->view('novo_telefone');
    }

    public function editar($id) {
        try {
            $this->load->model('telefone');
            $this->load->model('dao/telefoneDAO', 'td');
            $this->telefone->setId($id);
            $data = [
                'telefone' => $this->td->listarPorId($this->telefone),
            ];
            $this->load->view('editar_telefone', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function porAssociado($id) {
        try {
            $this->load->model('dao/telefoneDAO', 'td');
            $this->load->model('associado');
            $this->associado->setId($id);
            $data = ['telefones' => $this->td->listar($this->associado)];
            $this->load->view('telefones_por_associado', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function listarPorId($id) {
        try {
            $this->load->model('dao/telefoneDAO', 'td');
            $this->load->model('telefone');
            $this->telefone->setId($id);
            $data = ['telefone' => $this->td->listarPorId($this->telefone)];
            $this->load->view('editar_telefone', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function salvar($id, $idTelefone = null) {
        try {
            $this->load->model('telefone');
            $this->load->model('dao/telefoneDAO', 'td');
            $this->load->model('associado');
            $this->associado->setId($id);
            $this->telefone->setAssociado($this->associado);
            $this->telefone->setDdd($this->input->post('ddd'));
            $this->telefone->setTelefone($this->input->post('telefone'));
            if (empty($idTelefone)) {
                $this->td->inserir($this->telefone);
            } else {
                $this->telefone->setId($idTelefone);
                $this->td->alterar($this->telefone);
            }
            print json_encode(['status' => true]);
        } catch (Exception $e) {
            print json_encode([
                'status' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function excluir($id) {
        try {
            $this->load->model('telefone');
            $this->load->model('dao/telefoneDAO', 'td');
            $this->telefone->setId($id);
            $this->td->delete($this->telefone);
            print json_encode([
                'status' => true,
            ]);
        } catch (Exception $e) {
            print json_encode([
                'status' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }

}
