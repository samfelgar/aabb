<?php

class Fotos extends MY_Controller {

    public function nova($id, $tipo = 'associado', $acao = 'nova') {
        try {
            $dados = null;
            if ($tipo == 'associado') {
                $this->load->model('associado');
                $this->load->model('dao/associadoDAO', 'ad');
                $this->associado->setId($id);
                $dados = $this->ad->listarPorId($this->associado);
            } else {
                $this->load->model('dependente');
                $this->load->model('dao/dependenteDAO', 'dd');
                $this->dependente->setId($id);
                $dados = $this->dd->listarPorId($this->dependente);
            }
            $this->load->template('nova_foto', array(
                'active' => 'associados',
                'usuario' => $dados,
                'tipo' => $tipo,
                'acao' => $acao,
            ));
        } catch (Exception $ex) {
            $this->error($ex);
        }
    }

    /**
     *
     * O parâmetro $tipo deve ser 'associado' ou 'dependente'.
     *
     */
    public function alterar($tipo, $id) {
        $this->nova($id, $tipo, 'alterar');
    }

    public function salvar() {
        try {
            $photo = $this->input->post('photo');
            $usuario = $this->input->post('usuario');
            $tipo = $this->input->post('tipo');

            if (empty($photo) || empty($usuario)) {
                throw new Exception("Houve um erro na sua solicitação.");
            }

            $this->load->helper('file');
            $upload = './assets/avatars/';
            $img = str_replace('data:image/png;base64,', '', $photo);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = $upload . uniqid() . '.png';
            $success = file_put_contents($file, $data);

            if (!$success) {
                throw new Exception('Não foi possível criar o arquivo da foto.');
            }

            header("Content-Type: application/json; charset=UTF-8");
            switch ($tipo) {
            case 'associado':
                $this->load->model('associado');
                $this->load->model('dao/associadoDAO', 'ad');

                $this->associado->setId($usuario);
                $this->associado->setPhoto(str_replace('./', '', $file));
                if ($this->ad->photo($this->associado)) {
                    print json_encode(array('status' => true));
                } else {
                    throw new Exception('Não foi possível salvar a foto :( Tente novamente mais tarde.');
                }
                break;
            case 'dependente':
                $this->load->model('dependente');
                $this->load->model('dao/dependenteDAO', 'dd');
                $this->dependente->setId($usuario);
                $this->dependente->setPhoto(str_replace('./', '', $file));
                if ($this->dd->photo($this->dependente)) {
                    print json_encode(array(
                        'status' => true,
                        'associadoId' => $this->dd->getAssociadoId($this->dependente)->getAssociado()->getId(),
                    ));
                } else {
                    throw new Exception('Não foi possível salvar a foto :( Tente novamente mais tarde.');
                }
                break;
            default:
                throw new Exception('É necessário informar o tipo de usuário.');
                break;
            }
        } catch (Exception $ex) {
            $response = array(
                'status' => false,
                'error' => $ex->getMessage(),
            );
            header("Content-Type: application/json; charset=UTF-8");
            print json_encode($response);
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
