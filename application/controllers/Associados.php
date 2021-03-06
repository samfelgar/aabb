<?php

class Associados extends MY_Controller {

    private $active = 'associados';

    public function index() {
        try {
            $this->load->model('dao/associadoDAO', 'ad');
            $data = [
                'active' => $this->active,
                'associados' => $this->ad->listar(),
                'delete' => $this->input->get('delete')
            ];
            $this->load->template('associados', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function imprimir($id) {
        try {
            $this->load->model('associado');
            $this->load->model('dao/associadoDAO');
            $this->load->model('dao/telefoneDAO');
            $this->load->model('dao/enderecoDAO');
            $this->load->model('dao/planoDAO');
            $this->load->model('dao/dependenteDAO');
            $this->load->model('termo_adesao');
            $this->load->config('app_config');
            $this->associado->setId($id);
            $this->load->model('lancamento');
            $data_assinatura = new DateTime();
            $string_data = $data_assinatura->format('d');
            $string_data .= ' de ' . strtolower(Lancamento::MONTHS[$data_assinatura->format('m')]);
            $string_data .= ' de ' . $data_assinatura->format('Y');
            $data = [
                'active' => $this->active,
                'associado' => $this->associadoDAO->listarPorId($this->associado),
                'telefones' => $this->telefoneDAO->listar($this->associado),
                'enderecos' => $this->enderecoDAO->listar($this->associado),
                'dependentes' => $this->dependenteDAO->listar($this->associado),
                'termo' => $this->termo_adesao->get_terms(),
                'cidade' => $this->config->item('app_city'),
                'data_assinatura' => $string_data
            ];
            $this->load->view('impressao_ficha_associado', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function pesquisar_associado() {
        $this->load->template('pesquisar_cpf', [
            'active' => $this->active
        ]);
    }

    public function novo() {
        try {
            $this->load->model('dao/planoDAO', 'pd');
            $cpf = $this->input->post('cpf');
            if (empty($cpf)) {
                throw new Exception('É necessário pesquisar o CPF primeiro.');
            }
            $this->verificar_cpf($cpf);
            $data = [
                'active' => $this->active,
                'planos' => $this->pd->listar(),
                'cpf' => $cpf
            ];
            $this->load->template('novo_associado', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function ver($id) {
        try {
            $this->load->model('associado');
            $this->associado->setId($id);
            $this->load->model('dao/associadoDAO', 'ad');
            $this->load->model('dao/telefoneDAO', 'td');
            $this->load->model('dao/enderecoDAO', 'ed');
            $this->load->model('dao/planoDAO', 'pd');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->load->model('dao/associadoDocumentoDAO', 'add');
            $data = [
                'active' => $this->active,
                'associado' => $this->ad->listarPorId($this->associado),
                'telefones' => $this->td->listar($this->associado),
                'enderecos' => $this->ed->listar($this->associado),
                'planos' => $this->pd->listar(),
                'dependentes' => $this->dd->listar($this->associado),
                'documentos' => $this->add->listar($this->associado)
            ];
            $this->load->template('ver_associado', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function editar($id) {
        try {
            $this->load->model('associado');
            $this->associado->setId($id);
            $this->load->model('dao/associadoDAO', 'ad');
            $this->load->model('dao/planoDAO', 'pd');
            $this->load->model('dao/dependenteDAO', 'dd');
            $this->load->model('dao/associadoDocumentoDAO', 'add');
            $data = [
                'active' => $this->active,
                'associado' => $this->ad->listarPorId($this->associado),
                'planos' => $this->pd->listar(),
                'dependentes' => $this->dd->listar($this->associado),
                'documentos' => $this->add->listar($this->associado)
            ];
            $this->load->template('editar_associado', $data);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function salvar($id = null) {
        try {
            $this->load->model('associado');
            $this->load->model('dao/associadoDAO', 'ad');
            $this->load->model('plano');
            $this->associado->setNome($this->input->post('nome'));
            $this->associado->setCpf($this->input->post('cpf'));
            $this->associado->setRg($this->input->post('rg'));
            $this->associado->setNascimento($this->input->post('nascimento'), true);
            $this->associado->setEstadoCivil($this->input->post('estado-civil'));
            $this->associado->setEmail($this->input->post('email'));
            $this->associado->setAgencia($this->input->post('agencia'));
            $this->associado->setConta($this->input->post('conta'));
            $this->associado->setTipoConta($this->input->post('tipo-conta'));
            $this->associado->setTipoConta($this->input->post('tipo-conta'));
            $this->associado->setTipoConta($this->input->post('tipo-conta'));
            $this->associado->setDataAssociacao($this->input->post('data-associacao'), true);
            $this->associado->setFormaPagamento($this->input->post('forma-pagamento'));
            $this->plano->setId($this->input->post('plano'));
            $this->associado->setPlano($this->plano);
            if (!empty($id)) {
                $this->verificar_cpf($this->associado->getCpf(), 1); //Validando o CPF
                $this->associado->setId($id);
                $this->ad->alterar($this->associado);
                redirect('/associados/ver/' . $id);
            } else {
                $this->verificar_cpf($this->associado->getCpf()); //Validando o CPF
                $lastId = $this->ad->inserir($this->associado);
                if (empty($lastId)) {
                    throw new Exception("O associado não foi registrado corretamente.");
                }
                redirect('/fotos/nova/' . $lastId);
            }
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function desativar($id) {
        try {
            $this->load->model('associado');
            $this->load->model('dao/associadoDAO', 'ad');
            $this->associado->setId($id);
            $this->ad->disable($this->associado);
            redirect('/associados/editar/' . $this->associado->getId());
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function reativar($id) {
        try {
            $this->load->model('associado');
            $this->load->model('dao/associadoDAO');
            $this->associado->setId($id);
            $this->associadoDAO->enable($this->associado);
            redirect('/associados/editar/' . $this->associado->getId());
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function excluir($id) {
        try {
            $this->load->model('associado');
            $this->load->model('dao/associadoDAO');
            $this->associado->setId($id);
            $this->associadoDAO->delete($this->associado);
            redirect('/associados/?delete=true');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function desativados() {
        try {
            $this->load->model('dao/associadoDAO');
            $this->load->template('associados_desativados', [
                'active' => $this->active,
                'associados' => $this->associadoDAO->listar(0)
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    private function verificar_cpf($cpf, $qtd = 0) {
        try {
            $this->load->library('validador_cpf');
            if (!$this->validador_cpf->validar($cpf)) {
                throw new Exception('O CPF informado não é válido.');
            }
            $this->load->model('dao/associadoDAO');
            $qtdCPF = $this->associadoDAO->pesquisarCPF($cpf);
            if ($qtdCPF > $qtd) {
                $this->load->model('associado');
                $this->associado->setCpf($cpf);
                $this->associadoDAO->listarPorCpf($this->associado);
                throw new Exception('Já existe um associado cadastrado com o CPF informado 
                    (<a href="'. base_url('associados/ver/' . $this->associado->getId()) .'">' . $this->associado->getCpf() . '</a>).');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

}
