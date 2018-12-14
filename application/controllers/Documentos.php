<?php

class Documentos extends MY_Controller {

    public function novo() {
        try {
            $controller = $this->input->get('from');
            $id = $this->input->get('id');
            if (empty($controller) || empty($id)) {
                throw new Exception('Não é possível acessar esta página.');
            }
            $this->load->model('dao/tipoDocumentoDAO', 'tdd');
            $data = [
                'active' => $this->input->get('from'),
                'action' => base_url('documentos/salvar/?from=' . $controller . '&id=' . $id),
                'tipoDocumento' => $this->tdd->listar()
            ];
            $this->load->template('upload_documento', $data);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function salvar() {
        try {
            $controller = $this->input->get('from');
            $id = $this->input->get('id');
            $tipoDocumento = $this->input->post('tipo-documento');

            if (empty($controller) || empty($id)) {
                throw new Exception('Não é possível acessar esta página.');
            }

            if (empty($_FILES['document'])) {
                throw new Exception('É necessário selecionar um documento.');
            }

            $extensions = array('jpg', 'jpeg', 'png', 'pdf');
            $uploadFolder = './assets/documents/' . $controller . '/';
            $file = strtolower(basename($_FILES['document']['name']));
            $aFile = explode('.', $file);
            $fileExt = end($aFile);
            $fileSize = $_FILES['document']['size'];

            // Validações do arquivo
            if (!in_array($fileExt, $extensions)) {
                throw new Exception('O arquivo deve ter uma das seguintes extensões: JPG, JPEG, PNG ou PDF.');
            }

            if ($fileSize > 4194304) {
                throw new Exception('O arquivo deve ter no máximo 4 MB.');
            }

            // Atribuindo um nome único para o arquivo.
            $file = uniqid() . '.' . $fileExt;

            // Criando o diretório para upload, caso não exista
            if (!is_dir($uploadFolder)) {
                mkdir($uploadFolder);
            }

            $fullPath = $uploadFolder . $file;

            // Movendo o upload para a destino
            if (move_uploaded_file($_FILES['document']['tmp_name'], $fullPath)) {
                switch ($controller) {
                    case 'associados':
                        $this->load->model('associado');
                        $this->load->model('associadoDocumento');
                        $this->load->model('tipoDocumento');
                        $this->load->model('dao/associadoDocumentoDAO', 'ad');
                        $this->associado->setId($id);
                        $this->tipoDocumento->setId($tipoDocumento);
                        $this->associadoDocumento->setPath($fullPath);
                        $this->associadoDocumento->setTipoDocumento($this->tipoDocumento);
                        $this->associadoDocumento->setAssociado($this->associado);
                        $this->ad->inserir($this->associadoDocumento);
                        redirect('/associados/editar/' . $id);
                        break;
                    case 'dependentes':
                        $this->load->model('dependente');
                        $this->load->model('dao/dependenteDAO', 'ddao');
                        $this->load->model('dependenteDocumento');
                        $this->load->model('tipoDocumento');
                        $this->load->model('dao/dependenteDocumentoDAO', 'dd');
                        $this->dependente->setId($id);
                        $this->tipoDocumento->setId($tipoDocumento);
                        $this->dependenteDocumento->setPath($fullPath);
                        $this->dependenteDocumento->setTipoDocumento($this->tipoDocumento);
                        $this->dependenteDocumento->setDependente($this->dependente);
                        $this->dd->inserir($this->dependenteDocumento);
                        redirect('/associados/editar/' . $this->ddao->listarPorId($this->dependente)->getAssociado()->getId() . '/#dependentes');
                        break;
                    default:
                        throw new Exception('Acesso indevido!');
                }
            } else {
                throw new Exception('Não foi possível salvar o arquivo.');
            }
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function excluir($id) {
        try {
            $controller = $this->input->get('from');
            $fromId = $this->input->get('fromId');
            $path = $this->input->get('path');
            switch ($controller) {
                case 'associados':
                    $this->load->model('associadoDocumento');
                    $this->load->model('dao/associadoDocumentoDAO', 'ad');
                    $this->associadoDocumento->setId($id);
                    $this->ad->excluir($this->associadoDocumento);
                    unlink($path);
                    redirect('/associados/editar/' . $fromId);
                    break;
                case 'dependentes':
                    $this->load->model('dependenteDocumento');
                    $this->load->model('dao/dependenteDocumentoDAO', 'dd');
                    $this->load->model('dependente');
                    $this->load->model('dao/dependenteDAO', 'ddao');
                    $this->dependente->setId($fromId);
                    $associadoID = $this->ddao->listarPorId($this->dependente)->getAssociado()->getId();
                    $this->dependenteDocumento->setId($id);
                    $this->dd->excluir($this->dependenteDocumento);
                    unlink($path);
                    redirect('/associados/editar/' . $associadoID . '/#dependentes');
                    break;
                default:
                    throw new Exception('Acesso indevido!');
            }
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function porDependente($id = null) {
        try {
            if (empty($id)) {
                throw new Exception('O ID do dependente deve ser informado.');
            }
            $edit = $this->input->get('edit');
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDocumentoDAO', 'ddd');
            $this->dependente->setId($id);
            $this->load->view('documentos_dependente', [
                'documentos' => $this->ddd->listar($this->dependente),
                'dependente' => $this->dependente,
                'edit' => $edit
            ]);
        } catch (Exception $e) {
            $this->error($e);
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