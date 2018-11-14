<?php

class Associados extends MY_Controller {

  public function index() {
    try {
      $this->load->model('dao/associadoDAO', 'ad');
      $this->load->view('header', array(
        'active' => 'associados'
      ));
      $this->load->view('associados', array(
        'associados' => $this->ad->listar()
      ));
      $this->load->view('footer');
    } catch (Exception $ex) {
      $this->error($ex);
    }
  }

  public function novo() {
    try {
      $this->load->model('dao/planoDAO', 'pd');
      $this->load->view('header', array(
        'active' => 'associados'
      ));
      $this->load->view('novo_associado', array(
        'planos' => $this->pd->listar()
      ));
      $this->load->view('footer');
    } catch (Exception $ex) {
      $this->error($ex);
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
      $this->load->view('header', array(
        'active' => 'associados'
      ));
      $this->load->view('ver_associado', array(
        'associado' => $this->ad->listarPorId($this->associado),
        'telefones' => $this->td->listar($this->associado),
        'enderecos' => $this->ed->listar($this->associado),
        'planos' => $this->pd->listar(),
        'dependentes' => $this->dd->listar($this->associado)
      ));
      $this->load->view('footer');
    } catch (Exception $ex) {
      $this->error($ex);
    }
  }

  public function editar($id) {
    try {
      $this->load->model('associado');
      $this->associado->setId($id);
      $this->load->model('dao/associadoDAO', 'ad');
      $this->load->model('dao/planoDAO', 'pd');
      $this->load->model('dao/dependenteDAO', 'dd');
      $this->load->view('header', array(
        'active' => 'associados'
      ));
      $this->load->view('editar_associado', array(
        'associado' => $this->ad->listarPorId($this->associado),
        'planos' => $this->pd->listar(),
        'dependentes' => $this->dd->listar($this->associado)
      ));
      $this->load->view('footer');
    } catch (Exception $ex) {
      $this->error($ex);
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
        $this->associado->setId($id);
        $this->ad->alterar($this->associado);
        redirect('/associados/ver/' . $id);
      } else {
        $lastId = $this->ad->inserir($this->associado);
        if (empty($lastId)) {
          throw new Exception("O associado não foi registrado corretamente.");
        }
        redirect('/fotos/nova/' . $lastId);
      }
    } catch (Exception $ex) {
      $this->error($ex);
    }
  }

  public function desativar($id) {
    try {
      $this->load->model('associado');
      $this->load->model('dao/associadoDAO', 'ad');
      $this->associado->setId($id);
      $this->ad->disable($this->associado);
      redirect('/associados');
    } catch (Exception $e) {
      $this->error($e);
    }
  }

  private function error(Exception $ex) {
    $this->load->view('header', array(
      'active' => 'associados'
    ));
    $this->load->view('error', array(
      'error' => $ex->getMessage()
    ));
    $this->load->view('footer');
  }

}
