<?php

class Portaria extends MY_Controller {

    public function index($data = []) {
        try {
            $tipoPesquisa = $this->input->post('tipo-pesquisa');
            $search = preg_replace('/[\*]/', '', $this->input->post('search'));
            $data['alertTxt'] = null;
            $data['alertClass'] = null;
            $data['tipoPesquisa'] = $tipoPesquisa;
            switch ($tipoPesquisa) {
                case 'barcode':
                    $this->load->model('barcode');
                    $result = $this->barcode->ler($search);
                    $data['result'] = $result;
                    $data['pagamentos'] = $this->ultimosPagamentos($result);
                    break;
                case 'cpf':
                    $this->load->library('validador_cpf');
                    if (! $this->validador_cpf->validar($search)) {
                        throw new Exception('O CPF informado não é válido.');
                    }
                    $result = $this->pesquisarCPF($search);
                    $data['result'] = $result;
                    $data['pagamentos'] = $this->ultimosPagamentos($result);
                    break;
                case 'nome':
                    $result = $this->pesquisarNome($search);
                    $data['result_nome'] = $result;
                    break;
            }
            $this->load->view('portaria', $data);
        } catch (Exception $e) {
            $this->load->view('portaria', [
                'alertTxt' => $e->getMessage(),
                'alertClass' => 'alert-danger',
                'tipoPesquisa' => null
            ]);
        }
    }

    public function visualizar() {
        try {
            $class = $this->input->get('class');
            $id = $this->input->get('id');
            $data = [
                'alertTxt' => null,
                'alertClass' => null,
            ];
            switch ($class) {
                case 'associado':
                    $this->load->model('associado');
                    $this->load->model('dao/associadoDAO');
                    $this->associado->setId($id);
                    $data['result'] = $this->associadoDAO->listarPorId($this->associado);
                    $data['pagamentos'] = $this->ultimosPagamentos($this->associado);
                    break;
                case 'dependente':
                    $this->load->model('dependente');
                    $this->load->model('dao/dependenteDAO');
                    $this->dependente->setId($id);
                    $data['result'] = $this->dependenteDAO->listarPorId($this->dependente);
                    $data['pagamentos'] = $this->ultimosPagamentos($this->dependente);
                    break;
                default:
                    throw new Exception('Modalidade inválida.');
                    break;
            }
            $this->index($data);
        } catch (Exception $e) {
            $this->load->view('portaria', [
                'alertTxt' => $e->getMessage(),
                'alertClass' => 'alert-danger',
                'tipoPesquisa' => null
            ]);
        }
    }

    private function pesquisarCPF($cpf) {
        try {
            $this->load->model('associado');
            $this->load->model('dao/associadoDAO');
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDAO');
            $this->associado->setCpf($cpf);
            $this->dependente->setCpf($cpf);
            $associadoResult = $this->associadoDAO->listarPorCPF($this->associado);
            $dependenteResult = $this->dependenteDAO->listarPorCPF($this->dependente);
            if (! empty($associadoResult->getId())) {
                return $associadoResult;
            } else if (! empty($dependenteResult->getId())) {
                return $dependenteResult;
            } else {
                throw new Exception('CPF não encontrado.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function pesquisarNome($nome) {
        try {
            $this->load->model('associado');
            $this->load->model('dao/associadoDAO');
            $this->load->model('dependente');
            $this->load->model('dao/dependenteDAO');
            $this->associado->setNome($nome);
            $this->dependente->setNome($nome);
            $result[0] = $this->associadoDAO->listarPorNome($this->associado);
            $result[1] = $this->dependenteDAO->listarPorNome($this->dependente);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function ultimosPagamentos($registro, $max = 6, $interval = 12) {
        try {
            $class = strtolower(get_class($registro));
            $this->load->model('dao/lancamentoDAO');
            $lancamentos = null;
            switch ($class) {
                case 'associado':
                    $lancamentos = $this->lancamentoDAO->ultimosLancamentos($registro, $interval);
                    break;
                case 'dependente':
                    $lancamentos = $this->lancamentoDAO->ultimosLancamentos($registro->getAssociado(), $interval);
                    break;
                default:
                    throw new Exception('Não foi possível obter os últimos pagamentos.');
                    break;
            }
            if (count($lancamentos) <= $max) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

}