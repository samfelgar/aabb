<?php

class Validador_digito {

    public function gerar_digito($subject) {
        $subject = preg_replace('/[^0-9]/', '', $subject);
        $length = strlen($subject);
        $peso = 0;
        for ($i = 0, $j = $length + 1; $i < $length; $i++, $j--) {
            $peso += $subject[$i] * $j;
        }
        $digito = 11 - ($peso % 11);
        if ($digito > 9) {
            return 0;
        } else {
            return $digito;
        }
    }

    public function validar_digito($subject) {
        $subject = preg_replace('/[^0-9]/', '', $subject);
        $digit = $subject[strlen($subject) - 1];
        $length = strlen($subject) - 1;
        $subject = substr($subject, 0, $length);
        if ($this->gerar_digito($subject) == $digit) {
            return true;
        } else {
            return false;
        }
    }
}