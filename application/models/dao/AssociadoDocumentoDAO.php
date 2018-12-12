<?php

require_once 'DAO.php';

class AssociadoDocumentoDAO extends DAO {

    public function inserir(AssociadoDocumento $associadoDocumento) {
        try {
            $sql = 'INSERT INTO associados_documentos (path, associados_id, tipos_documentos_id) VALUES (?,?,?)';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute([
                $associadoDocumento->getPath(),
                $associadoDocumento->getAssociado()->getId(),
                $associadoDocumento->getTipoDocumento()->getId()
            ]);
            if (!$result) {
                throw new Exception('<strong>[INSERIR ASSOCIADO_DOCUMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $this->c->lastInsertId();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function alterar(AssociadoDocumento $associadoDocumento) {
        try {
            $sql = 'UPDATE associados_documentos SET path = ?, tipos_documentos_id = ? WHERE id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute([
                $associadoDocumento->getPath(),
                $associadoDocumento->getTipoDocumento()->getId(),
                $associadoDocumento->getId()
            ]);
            if (!$result) {
                throw new Exception('<strong>[ALTERAR ASSOCIADO_DOCUMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function excluir(AssociadoDocumento $associadoDocumento) {
        try {
            $sql = 'DELETE FROM associados_documentos WHERE id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute([
                $associadoDocumento->getId()
            ]);
            if (!$result) {
                throw new Exception('<strong>[EXCLUIR ASSOCIADO_DOCUMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function listar(Associado $associado) {
        try {
            $this->load->model('associadoDocumento');
            $this->load->model('tipoDocumento');
            $sql = 'SELECT ad.id, ad.path, td.descricao AS tipo '
            . 'FROM associados_documentos ad '
            . 'INNER JOIN tipos_documentos td '
            . 'ON ad.tipos_documentos_id = td.id '
            . 'WHERE ad.associados_id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([$associado->getId()])) {
                throw new Exception('<strong>[LISTAR ASSOCIADO_DOCUMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            $result = [];
            while ($r = $stm->fetch(PDO::FETCH_ASSOC)) {
                $associadoDocumento = new AssociadoDocumento();
                $tipoDocumento = new TipoDocumento();
                $associadoDocumento->setId($r['id']);
                $associadoDocumento->setPath($r['path']);
                $associadoDocumento->setAssociado($associado);
                $tipoDocumento->setDescricao($r['tipo']);
                $associadoDocumento->setTipoDocumento($tipoDocumento);
                $result[] = $associadoDocumento;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

}