<?php

class Financeiro extends MY_Controller {

  public function index() {
    $this->load->model('dao/associadoDAO', 'ad');
    $this->load->view('header', ['active' => 'financeiro']);
    $this->load->view('financeiro/pesquisa_associado', ['associados' => $this->ad->listar()]);
    $this->load->view('footer');
  }

  public function overview($id) {
    try {
      $this->load->model('associado');
      $this->load->model('lancamento');
      $this->load->model('dao/associadoDAO', 'ad');
      $this->load->model('dao/lancamentoDAO', 'ld');
      $this->associado->setId($id);
      $this->load->view('header', ['active' => 'financeiro']);
      $this->load->view('financeiro/visao_geral', [
        'associado' => $this->ad->listarPorId($this->associado),
        'lancamentos' => $this->checkPayment($this->ld->ultimosLancamentos($this->associado))
      ]);
      $this->load->view('footer');
    } catch (Exception $e) {
      $this->error($e);
    }
  }

  public function inadimplentes() {
    try {
      $this->load->model('dao/lancamentoDAO', 'ld');
      $this->load->model('dao/associadoDAO', 'ad');
      $date = new DateTime();
      $date->modify('-1 month');
      $array = [];
      for ($i = 0; $i < 3; $i++) {
        $ids = $this->ld->inadimplentes($date->format('Y'), $date->format('m'));
        for ($j = 0; $j < count($ids); $j++) {
          $array[] = [$date->format('Y-m-d'), $this->ad->listarMenos($ids[$j])];
        }
        $date->modify('-1 month');
      }
      print '<pre>' . var_export($array, true) . '</pre>';
      $this->output->enable_profiler(TRUE);
    } catch (Exception $e) {
      $this->error($e);
    }
  }

  public function salvar() {
    try {
      $this->load->model('associado');
      $this->load->model('lancamento');
      $this->load->model('dao/lancamentoDAO', 'ld');
      $this->associado->setId($this->input->post('associado-id'));
      $this->lancamento->setAssociado($this->associado);
      $this->lancamento->setValor($this->input->post('plano-valor'));
      $year = $this->input->post('ano');
      $months = $this->input->post('meses[]');
      if (empty($months)) {
        throw new Exception('Você deve selecionar pelo menos um lançamento.');
      }
      for ($i = 0; $i < count($months); $i++) {
        $date = new DateTime();
        $date->setDate($year, $months[$i], 1);
        $this->lancamento->setData($date->format('Y-m-d'));
        $this->ld->inserir($this->lancamento);
      }
      redirect('financeiro/overview/' . $this->associado->getId());
    } catch (Exception $e) {
      $this->error($e);
    }
  }

  public function lancamentosPorAno($associadoId, $year = null) {
    try {
      $this->load->model('associado');
      $this->load->model('lancamento');
      $this->load->model('dao/lancamentoDAO', 'ld');
      $this->associado->setId($associadoId);
      if (empty($year)) {
        $date = new DateTime();
        $year = $date->format('Y');
      }
      $this->load->view('financeiro/lancamentos_ano_checkboxes', [
        'checkboxes' => $this->ld->lancamentosPorAno($this->associado, $year)
      ]);
    } catch (Exception $e) {
      $this->load->view('error', ['error' => $e->getMessage()]);
    }
  }

  /*
  * Método irá retornar um array com os últimos 12 meses pagos
  */
  private function checkPayment($data) {
    $dt = new DateTime();
    $array = [];
    for ($i = 0; $i < 12; $i++) {
      $paid = false;
      for ($j = 0; $j < count($data); $j++) {
        if ($data[$j]->getYear() == $dt->format('Y') && $data[$j]->getMonth() == $dt->format('m')) {
          $paid = true;
        }
      }
      $array[] = [
        $dt->format('Y-m-d'),
        $paid
      ];
      $dt->modify('-1 month');
    }
    return $array;
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
