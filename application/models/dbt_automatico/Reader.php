<?php

class Reader extends CI_Model {

    public function ler($path) {
        try {
            $lines = file($path, FILE_IGNORE_NEW_LINES);
            $result = [];
            foreach ($lines as $line) {
                switch (strtoupper($line[0])) {
                    case 'A':
                        $this->load->model('dbt_automatico/registroA');
                        $registroA = new RegistroA();
                        $registroA->setFromLine($line);
                        $result[] = $registroA;
                        break;
                    case 'B':
                        $this->load->model('dbt_automatico/registroB');
                        $registroB = new RegistroB();
                        $registroB->setFromLine($line);
                        $result[] = $registroB;
                        break;
                    case 'C':
                        $this->load->model('dbt_automatico/registroC');
                        $registroC = new RegistroC();
                        $registroC->setFromLine($line);
                        $result[] = $registroC;
                        break;
                    case 'D':
                        $this->load->model('dbt_automatico/registroD');
                        $registroD = new RegistroD();
                        $registroD->setFromLine($line);
                        $result[] = $registroD;
                        break;
                    case 'E':
                        $this->load->model('dbt_automatico/registroE');
                        $registroE = new RegistroE();
                        $registroE->setFromLine($line);
                        $result[] = $registroE;
                        break;
                    case 'F':
                        $this->load->model('dbt_automatico/registroF');
                        $registroF = new RegistroF();
                        $registroF->setFromLine($line);
                        $result[] = $registroF;
                        break;
                    case 'H':
                        $this->load->model('dbt_automatico/registroH');
                        $registroH = new RegistroH();
                        $registroH->setFromLine($line);
                        $result[] = $registroH;
                        break;
                    case 'Z':
                        $this->load->model('dbt_automatico/registroZ');
                        $registroZ = new RegistroZ();
                        $registroZ->setFromLine($line);
                        $result[] = $registroZ;
                        break;
                }
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}