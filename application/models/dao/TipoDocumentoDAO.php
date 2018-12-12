<?php

require_once 'DAO.php';

class TipoDocumentoDAO extends DAO {

    public function listar() {
        try {
            $sql = 'SELECT id, descricao FROM tipos_documentos';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute()) {
                throw new Exception('<strong>[LISTAR TIPO_DOCUMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            $result = [];
            while ($r = $stm->fetch(PDO::FETCH_ASSOC)) {
                $this->load->model('tipoDocumento');
                $tipoDocumento = new TipoDocumento();
                $tipoDocumento->setId($r['id']);
                $tipoDocumento->setDescricao($r['descricao']);
                $result[] = $tipoDocumento;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}