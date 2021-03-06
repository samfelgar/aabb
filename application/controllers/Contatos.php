<?php

class Contatos extends MY_Controller {

    private $active = 'associados';

    public function novo($associadoId) {
        try {
            $this->load->model('associado');
            $this->load->model('dao/associadoDAO', 'ad');
            $this->associado->setId($associadoId);
            $data = [
                'active' => $this->active,
                'associado' => $this->ad->listarPorId($this->associado),
            ];
            $this->load->template('novo_telefone_endereco', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function salvar() {
        try {
            $this->load->model('telefone');
            $this->load->model('dao/telefoneDAO', 'td');
            $this->load->model('endereco');
            $this->load->model('dao/enderecoDAO', 'ed');
            $this->load->model('associado');
            $this->associado->setId($this->input->post('id'));
            $this->telefone->setAssociado($this->associado);
            $this->endereco->setAssociado($this->associado);
            for ($i = 0; $i < count($this->input->post('ddd')); $i++) {
                $this->telefone->setDdd($this->input->post('ddd')[$i]);
                $this->telefone->setTelefone($this->input->post('telefone')[$i]);
                $this->td->inserir($this->telefone);
            }
            $this->endereco->setLogradouro($this->input->post('logradouro'));
            $this->endereco->setNumero($this->input->post('numero'));
            $this->endereco->setBairro($this->input->post('bairro'));
            $this->endereco->setComplemento($this->input->post('complemento'));
            $this->endereco->setCidade($this->input->post('cidade'));
            $this->endereco->setEstado($this->input->post('estado'));
            $this->endereco->setCep($this->input->post('cep'));
            $this->ed->inserir($this->endereco);
            redirect('/associados/editar/' . $this->associado->getId());
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

}
