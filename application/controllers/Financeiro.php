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

    public function upload_retorno() {
        $this->load->template('financeiro/upload_retorno', [
            'active' => 'Financeiro'
        ]);
    }

    public function ler_retorno() {
        try {
            if (empty($_FILES['document'])) {
                throw new Exception('É necessário selecionar um documento.');
            }
            // Verificando extensões aceitas
            $extensions = ['txt', 'ret'];
            $file_name = explode('.', $_FILES['document']['name']);
            $file_extension = end($file_name);
            if (! in_array($file_extension, $extensions)) {
                throw new Exception('Extensão do arquivo inválida.');
            }

            // Verificando tamanho do arquivo
            if ($_FILES['document']['size'] > 2097152) {
                throw new Exception('O arquivo deve ter no máximo 2 MB.');
            }

            $tmp_name = $_FILES['document']['tmp_name'];
            $this->load->model('dbt_automatico/reader');
            $registros = $this->reader->ler($tmp_name);
            $this->load->template('financeiro/ler_retorno', [
                'active' => 'Financeiro',
                'registros' => $registros
            ]);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    public function gravar_lancamentos_retorno() {
        try {
            $identificacao = $this->input->post('identificacao');
            $agencia = $this->input->post('agencia');
            $valor = $this->input->post('valor');
            $data = $this->input->post('data');
            $retorno = $this->input->post('retorno');
            if (
                count($identificacao) != count($agencia) ||
                count($identificacao) != count($valor) ||
                count($identificacao) != count($data) ||
                count($identificacao) != count($retorno)
            ) {
                throw new Exception('Parâmetros inválidos.');
            }
            $this->load->model('dbt_automatico/registroF');
            $registros = [];
            foreach ($identificacao as $k => $registro) {
                $registro_f = new RegistroF();
                $registro_f->setF04($registro);
                $registro_f->setF03($agencia[$k]);
                $registro_f->setF06($valor[$k]);
                $registro_f->setF05($data[$k]);
                $registro_f->setF07($retorno[$k]);
                $registros[] = $registro_f;
            }
            $result = $this->gerar_lancamentos_dbt($registros);
            $this->load->template('financeiro/gravar_lancamentos_retorno', [
                'active' => 'Financeiro',
                'resultados' => $result
            ]);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    private function gerar_lancamentos_dbt(array $registros) {
        try {
            $this->load->model('associado');
            $this->load->model('lancamento');
            $this->load->model('dao/associadoDAO');
            $this->load->model('dao/lancamentoDAO');
            $this->load->library('validador_digito');
            $not_found = [];
            $not_paid = [];
            $incorrect_value = [];
            $duplicated = [];
            $success = [];
            foreach ($registros as $registro) {
                if ($registro->getF07() != '00') {
                    $not_paid[] = $registro;
                    continue;
                }
                $associado = new Associado();
                $conta = number_format($registro->getF04(), 0, '', '.') . '-' . $this->validador_digito->gerar_digito($registro->getF04());
                $age = number_format($registro->getF03(), 0, '', '.') . '-' . $this->validador_digito->gerar_digito($registro->getF03());
                $associado->setConta($conta);
                $associado->setAgencia($age);
                if (! $this->associadoDAO->listarPorAgenciaConta($associado)) {
                    $not_found[] = $registro;
                    continue;
                }
                if ($associado->getPlano()->getValor() != $registro->getF06()) {
                    $incorrect_value[] = $registro;
                    continue;
                }
                $lancamento = new Lancamento();
                $lancamento->setData($registro->getF05());
                $lancamento->setValor($registro->getF06());
                $lancamento->setAssociado($associado);
                if ($this->lancamentoDAO->check_lancamento($lancamento)) {
                    $duplicated[] = $registro;
                    continue;
                }
                $this->lancamentoDAO->inserir($lancamento);
                $success[] = $lancamento;
            }
            return [$success, $not_paid, $incorrect_value, $not_found, $duplicated];
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*
     * Método irá retornar um array com os últimos 12 meses pagos
     */
    private function checkPayment($data) {
        $dt = new DateTime();
        if ($dt->format('d') == 31) {
            $dt->modify('-1 day');
        }
        $dt->modify('-1 month');
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
