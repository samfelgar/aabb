<?php

class Financeiro extends MY_Controller {

    public function index() {
        $this->load->model('dao/associadoDAO', 'ad');
        $data = [
            'active' => 'financeiro',
            'associados' => $this->ad->listar(),
        ];
        $this->load->template('financeiro/pesquisa_associado', $data);
    }

    public function overview($id) {
        try {
            $this->load->model('associado');
            $this->load->model('lancamento');
            $this->load->model('dao/associadoDAO', 'ad');
            $this->load->model('dao/lancamentoDAO', 'ld');
            $this->associado->setId($id);
            $data = [
                'active' => 'financeiro',
                'associado' => $this->ad->listarPorId($this->associado),
                'lancamentos' => $this->checkPayment($this->ld->ultimosLancamentos($this->associado)),
            ];
            $this->load->template('financeiro/visao_geral', $data);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function inadimplentes() {
        $date = new DateTime();
        $data = [
            'active' => 'financeiro',
            'year' => $date->format('Y'),
        ];
        $this->load->model('lancamento');
        $this->load->template('financeiro/pesquisar_inad', $data);
    }

    public function inad() {
        try {
            $this->load->model('dao/lancamentoDAO', 'ld');
            $this->load->model('dao/associadoDAO', 'ad');
            $year = $this->input->get('ano');
            $month = $this->input->get('mes');
            $inad = [];
            $ids = $this->ld->inadimplentes($year, $month);
            for ($j = 0; $j < count($ids); $j++) {
                $inad[] = $this->ad->listarMenos($ids[$j]);
            }
            $data = [
                'active' => 'financeiro',
                'associados' => $inad,
                'year' => $year,
                'month' => $month,
            ];
            $this->load->template('financeiro/inadimplentes', $data);
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
                'checkboxes' => $this->ld->lancamentosPorAno($this->associado, $year),
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
        $data = [
            'active' => 'financeiro',
            'error' => $ex->getMessage(),
        ];
        $this->load->template('error', $data);
    }
}
