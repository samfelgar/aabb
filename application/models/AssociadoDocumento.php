<?php

class AssociadoDocumento extends CI_Model {

    protected $id;
    protected $path;
    protected $associado;
    protected $tipoDocumento;

    public function getId() {
        return $this->id;
    }

    public function getPath() {
        return $this->path;
    }

    public function getAssociado() {
        return $this->associado;
    }

    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function setAssociado(Associado $associado) {
        $this->associado = $associado;
    }

    public function setTipoDocumento(TipoDocumento $tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }
}