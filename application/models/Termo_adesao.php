<?php

class Termo_adesao extends CI_Model {

    private $terms_file = './assets/documents/terms.txt';

    public function get_terms() {
        try {
            $filesize = filesize($this->terms_file);
            if ($filesize > 0) {
                $resource = fopen($this->terms_file, 'r');
                $terms = fread($resource, $filesize);
                fclose($resource);
            } else {
                $terms = null;
            }
            return $terms;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function set_terms($terms) {
        try {
            if (! is_writable($this->terms_file)) {
                throw new Exception('Não foi possível salvar as alterações no Termo de Adesão. Verifique as permissões do arquivo.');
            }
            $resource = fopen($this->terms_file, 'w');
            fwrite($resource, $terms);
            fclose($resource);
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
}