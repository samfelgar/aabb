<?php

require_once 'DAO.php';

class TaxaDAO extends DAO {

    public function inserir(Taxa $taxa) {
        try {
            $sql = 'INSERT INTO taxas (descricao, valor, parcelas, gratuidade) VALUES (?,?,?,?)';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $taxa->getDescricao(),
                        $taxa->getValor(),
                        $taxa->getParcelas(),
                        $taxa->getGratuidade()
                    ])) {
                throw new Exception('[INSERIR TAXA] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function alterar(Taxa $taxa) {
        try {
            $sql = 'UPDATE taxas SET descricao = ?, valor = ?, parcelas = ?, gratuidade = ? WHERE id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $taxa->getDescricao(),
                        $taxa->getValor(),
                        $taxa->getParcelas(),
                        $taxa->getGratuidade(),
                        $taxa->getId()
                    ])) {
                throw new Exception('[ALTERAR TAXA] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function listar() {
        try {
            $sql = 'SELECT * FROM taxas';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute()) {
                throw new Exception('[LISTAR TAXAS] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            $result = [];
            $this->load->model('taxa');
            while ($r = $stm->fetch(PDO::FETCH_ASSOC)) {
                $taxa = new Taxa();
                $taxa->setId($r['id']);
                $taxa->setDescricao($r['descricao']);
                $taxa->setValor($r['valor']);
                $taxa->setParcelas($r['parcelas']);
                $taxa->setGratuidade($r['gratuidade']);
                $result[] = $taxa;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function listarPorId(Taxa $taxa) {
        try {
            $sql = 'SELECT * FROM taxas WHERE id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $taxa->getId()
                    ])) {
                throw new Exception('[LISTAR TAXAS] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            $r = $stm->fetch(PDO::FETCH_ASSOC);
            $this->load->model('taxa');
            $this->taxa->setId($r['id']);
            $this->taxa->setDescricao($r['descricao']);
            $this->taxa->setValor($r['valor']);
            $this->taxa->setParcelas($r['parcelas']);
            $this->taxa->setGratuidade($r['gratuidade']);
            return $this->taxa;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function excluir(Taxa $taxa) {
        try {
            $sql = 'DELETE FROM taxas WHERE id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $taxa->getId()
                    ])) {
                throw new Exception('[LISTAR TAXAS] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

}
