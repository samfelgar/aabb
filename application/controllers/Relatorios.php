<?php

class Relatorios extends MY_Controller {

    private $active = 'associados';

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
                'active' => 'associados',
                'relacao' => $result,
                'totalAssociados' => $totalAssociados,
                'totalDependentes' => $totalDependentes
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

}