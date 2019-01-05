<?php

class Enderecos extends MY_Controller {

    private $active = 'associados';

    public function novo() {
        $this->load->view('novo_endereco');
    }

    public function editar($id) {
        try {
            $this->load->model('endereco');
            $this->load->model('dao/enderecoDAO', 'ed');
            $this->endereco->setId($id);
            $data = [
                'endereco' => $this->ed->listarPorId($this->endereco),
            ];
            $this->load->view('editar_endereco', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function porAssociado($id) {
        try {
            $this->load->model('dao/enderecoDAO', 'ed');
            $this->load->model('associado');
            $this->associado->setId($id);
            $data = ['enderecos' => $this->ed->listar($this->associado)];
            $this->load->view('enderecos_por_associado', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function salvar($id, $idEndereco = null) {
        try {
            $this->load->model('endereco');
            $this->load->model('dao/enderecoDAO', 'ed');
            $this->load->model('associado');
            $this->associado->setId($id);
            $this->endereco->setAssociado($this->associado);
            $this->endereco->setLogradouro($this->input->post('logradouro'));
            $this->endereco->setNumero($this->input->post('numero'));
            $this->endereco->setBairro($this->input->post('bairro'));
            $this->endereco->setComplemento($this->input->post('complemento'));
            $this->endereco->setCidade($this->input->post('cidade'));
            $this->endereco->setEstado($this->input->post('estado'));
            $this->endereco->setCep($this->input->post('cep'));
            if (empty($idEndereco)) {
                $this->ed->inserir($this->endereco);
            } else {
                $this->endereco->setId($idEndereco);
                $this->ed->alterar($this->endereco);
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
            $this->load->model('endereco');
            $this->load->model('dao/enderecoDAO', 'ed');
            $this->endereco->setId($id);
            $this->ed->delete($this->endereco);
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
