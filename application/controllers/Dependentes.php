<?php

class Dependentes extends MY_Controller {

    public function novo() {
        $this->load->view('novo_dependente');
    }

    public function editar($id) {
        try {
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->dependente->setId($id);
            $data = [
                'dependente' => $this->dd->listarPorId($this->dependente),
            ];
            $this->load->view('editar_dependente', $data);
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

    public function salvar($id, $idDependente = null) {
        try {
            $this->load->model('associado');
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->associado->setId($id);
            $this->dependente->setAssociado($this->associado);
            $this->dependente->setNome($this->input->post('nome'));
            $this->dependente->setNascimento($this->input->post('nascimento'), true);
            $this->dependente->setCpf($this->input->post('cpf'));
            $this->dependente->setParentesco($this->input->post('parentesco'));
            if (empty($idDependente)) {
                $this->dd->inserir($this->dependente);
            } else {
                $this->dependente->setId($idDependente);
                $this->dd->alterar($this->dependente);
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
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->dependente->setId($id);
            $this->dd->delete($this->dependente);
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
