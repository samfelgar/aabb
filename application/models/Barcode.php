<?php

class Barcode extends CI_Model {

    public function ler($code) {
        try {
            if (empty($code)) {
                throw new Exception('[BARCODE] O código não deve estar vazio.');
            }
            if (strlen($code) != 7) {
                throw new Exception('[BARCODE] Código inválido.');
            }
            $char = strtoupper(substr($code, 0, 1));
            $code = (int) substr($code, 1);
            switch ($char) {
                case 'A':
                    $this->load->model('associado');
                    $this->load->model('dao/associadoDAO');
                    $this->associado->setId($code);
                    return $this->associadoDAO->listarPorId($this->associado);
                    break;
                case 'D':
                    $this->load->model('dependente');
                    $this->load->model('dao/dependenteDAO');
                    $this->dependente->setId($code);
                    return $this->dependenteDAO->listarPorId($this->dependente);
                    break;
                default:
                    throw new Exception('[BARCODE] Código inválido.');
                    break;
            }
            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function gerarCodigoDependente(Dependente $dependente) {
        try {
            $char = 'D';
            $code = (string) str_pad($dependente->getId(), 6, '0', STR_PAD_LEFT);
            return $char . $code;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function gerarCodigoAssociado(Associado $associado) {
        try {
            $char = 'A';
            $code = (string) str_pad($associado->getId(), 6, '0', STR_PAD_LEFT);
            return $char . $code;
        } catch (Exception $e) {
            throw $e;
        }
    }
}