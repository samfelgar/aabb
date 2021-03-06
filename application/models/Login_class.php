<?php

class Login_class extends CI_Model {

    protected $id;
    protected $user;
    protected $pass;
    protected $perfil;

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * 
     * @param string $pass Senha a ser definida
     * @param bool $hash Se verdadeiro, a propriedade é definida como hash, utilizando password_hash
     */
    public function setPass($pass, $hash = false) {
        if ($hash) {
            $this->pass = password_hash($pass, PASSWORD_DEFAULT);
        } else {
            $this->pass = $pass;
        }
    }

    public function setPerfil(Perfil $perfil) {
        $this->perfil = $perfil;
    }

}
