<?php

class Dependentes extends MY_Controller {

    public function novo() {
        try {
            $id = $this->input->get('id');
            if (empty($id)) {
                throw new Exception('Não é possível acessar esta página.');
            }

            $this->load->model('associado');
            $this->load->model('dao/associadoDAO', 'ad');
            $this->associado->setId($id);

            $this->load->template('novo_dependente', [
                'active' => 'associados',
                'associado' => $this->ad->listarMenos($this->associado)
            ]);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function editar($id) {
        try {
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->dependente->setId($id);
            $data = [
                'active' => 'associados',
                'dependente' => $this->dd->listarPorId($this->dependente),
            ];
            $this->load->template('editar_dependente', $data);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function porAssociado($id) {
        try {
            $this->load->model('associado');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->associado->setId($id);
            $data = [
                'dependentes' => $this->dd->listar($this->associado),
            ];
            $this->load->view('dependentes_por_associado', $data);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function salvar($idDependente = null) {
        try {
            $this->load->model('associado');
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->dependente->setNome($this->input->post('nome'));
            $this->dependente->setNascimento($this->input->post('nascimento'), true);
            $this->dependente->setCpf($this->input->post('cpf'));
            $this->dependente->setParentesco($this->input->post('parentesco'));
            $associadoID = null;
            if (empty($idDependente)) {
                $this->associado->setId($this->input->post('associado-id'));
                $associadoID = $this->associado->getId();
                $this->dependente->setAssociado($this->associado);
                $this->dd->inserir($this->dependente);
            } else {
                $this->dependente->setId($idDependente);
                $this->dd->alterar($this->dependente);
                $associadoID = $this->dd->listarPorId($this->dependente)->getAssociado()->getId();
            }
            redirect('associados/editar/' . $associadoID . '/#dependentes');
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function excluir($id = null) {
        try {
            $associadoID = $this->input->get('id');
            if (empty($id) || empty($associadoID)) {
                throw new Exception('Não foi possível acessar esta página.');
            }
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->dependente->setId($id);
            $this->dd->delete($this->dependente);
            redirect('associados/editar/' . $associadoID . '/#dependentes');
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function buscarFoto($id) {
        try {
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->dependente->setId($id);
            $this->dependente = $this->dd->buscarFoto($this->dependente);
            header("Content-Type: application/json; charset=UTF-8");
            $data = array(
                'photo' => $this->dependente->getPhoto(true),
                'status' => true,
            );
            print json_encode($data);
        } catch (Exception $e) {
            header("Content-Type: application/json; charset=UTF-8");
            $data = array(
                'status' => false,
                'error' => $e->getMessage(),
            );
            print json_encode($data);
        }
    }

    private function error(Exception $ex) {
        $data = [
            'active' => 'associados',
            'error' => $ex->getMessage(),
        ];
        $this->load->template('error', $data);
    }
}