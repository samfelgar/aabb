<?php

class DependenteDocumento extends CI_Model {

    protected $id;
    protected $path;
    protected $dependente;
    protected $tipoDocumento;

    public function getId() {
        return $this->id;
    }

    public function getPath() {
        return $this->path;
    }

    public function getDependente() {
        return $this->dependente;
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

    public function setDependente(Dependente $dependente) {
        $this->dependente = $dependente;
    }

    public function setTipoDocumento(TipoDocumento $tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }
}