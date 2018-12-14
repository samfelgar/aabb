<?php

require_once 'DAO.php';

class DependenteDocumentoDAO extends DAO {

    public function inserir(DependenteDocumento $dependenteDocumento) {
        try {
            $sql = 'INSERT INTO dependentes_documentos (path, dependentes_id, tipos_documentos_id) VALUES (?,?,?)';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute([
                $dependenteDocumento->getPath(),
                $dependenteDocumento->getDependente()->getId(),
                $dependenteDocumento->getTipoDocumento()->getId()
            ]);
            if (!$result) {
                throw new Exception('<strong>[INSERIR DEPENDENTE_DOCUMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $this->c->lastInsertId();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function alterar(DependenteDocumento $dependenteDocumento) {
        try {
            $sql = 'UPDATE dependentes_documentos SET path = ?, tipos_documentos_id = ? WHERE id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute([
                $dependenteDocumento->getPath(),
                $dependenteDocumento->getTipoDocumento()->getId(),
                $dependenteDocumento->getId()
            ]);
            if (!$result) {
                throw new Exception('<strong>[ALTERAR DEPENDENTE_DOCUMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function excluir(DependenteDocumento $dependenteDocumento) {
        try {
            $sql = 'DELETE FROM dependentes_documentos WHERE id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute([
                $dependenteDocumento->getId()
            ]);
            if (!$result) {
                throw new Exception('<strong>[EXCLUIR DEPENDENTE_DOCUMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function listar(Dependente $dependente) {
        try {
            $this->load->model('dependenteDocumento');
            $this->load->model('tipoDocumento');
            $sql = 'SELECT dd.id, dd.path, td.descricao AS tipo '
            . 'FROM dependentes_documentos dd '
            . 'INNER JOIN tipos_documentos td '
            . 'ON dd.tipos_documentos_id = td.id '
            . 'WHERE dd.dependentes_id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([$dependente->getId()])) {
                throw new Exception('<strong>[LISTAR DEPENDENTE_DOCUMENTO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            $result = [];
            while ($r = $stm->fetch(PDO::FETCH_ASSOC)) {
                $dependenteDocumento = new DependenteDocumento();
                $tipoDocumento = new TipoDocumento();
                $dependenteDocumento->setId($r['id']);
                $dependenteDocumento->setPath($r['path']);
                $dependenteDocumento->setDependente($dependente);
                $tipoDocumento->setDescricao($r['tipo']);
                $dependenteDocumento->setTipoDocumento($tipoDocumento);
                $result[] = $dependenteDocumento;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

}