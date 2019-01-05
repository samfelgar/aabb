<?php

class Termo extends MY_Controller {

    private $active = 'sistema';

    public function editar() {
        try {
            $this->load->model('termo_adesao');
            $this->load->template('settings/terms', [
                'active' => 'sistema',
                'terms' => $this->termo_adesao->get_terms(),
                'updated' => $this->input->get('updated')
            ]);
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }

    public function salvar() {
        try {
            $this->load->model('termo_adesao');
            $this->termo_adesao->set_terms($this->input->post('terms'));
            redirect('termo/editar/?updated=true');
        } catch (Exception $e) {
            $this->error($e, $this->active);
        }
    }
}