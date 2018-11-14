<?php

require_once 'DAO.php';

class LoginDAO extends DAO {

  public function checkUserPass(Login_class $login) {
    try {
      $sql = 'select * from login where user = ?';
      $stmt = $this->c->prepare($sql);
      if (!$stmt->execute([$login->getUser()])) {
        throw new Exception('<strong>[CHECK USER_PASS]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
      }
      if ($stmt->rowCount() < 1) {
        return false;
      }
      $r = $stmt->fetch(PDO::FETCH_ASSOC);
      $l = new Login_class();
      $l->setId($r['id']);
      $l->setPass($r['pass']);
      $this->load->model('perfil');
      $this->perfil->setId($r['perfis_id']);
      $l->setPerfil($this->perfil);
      return $l;
    } catch (Exception $e) {
      throw $e;
    }
  }
}
