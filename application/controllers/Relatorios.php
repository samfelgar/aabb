<?php

class Relatorios extends MY_Controller {

    public function relacaoAssociados() {
        try {
            $this->load->model('associado');
            $this->load->model('dependente');
            $this->load->model('dao/associadoDAO');
            $this->load->model('dao/dependenteDAO');
            $associados = $this->associadoDAO->listar(1, 'p.descricao');
            $result = [];
            $totalAssociados = count($associados);
            $totalDependentes = 0;
            foreach ($associados as $associado) {
                $dependentes = $this->dependenteDAO->listar($associado);
                $totalDependentes += count($dependentes);
                $result[] = [$associado, $dependentes];
            }
            $this->load->template('relatorios/relacao_associados', [
                'active' => 'relatorios',
                'relacao' => $result,
                'totalAssociados' => $totalAssociados,
                'totalDependentes' => $totalDependentes
            ]);
        } catch (Exception $e) {
            $this->error($e);
        }
    }

    private function error(Exception $ex) {
        $data = [
            'active' => 'relatorios',
            'error' => $ex->getMessage(),
        ];
        $this->load->template('error', $data);
    }
}