<?php

require_once 'DAO.php';

class TaxaAssociadoDAO extends DAO {

    public function inserir(TaxaAssociado $taxa_associado) {
        try {
            $sql = 'INSERT INTO taxas_associados (taxas_id, associados_id, valor_pago, data, parcela, aberto) VALUES (?,?,?,?,?,?)';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $taxa_associado->getTaxa()->getId(),
                        $taxa_associado->getAssociado()->getId(),
                        $taxa_associado->getValorPago(),
                        $taxa_associado->getData(),
                        $taxa_associado->getParcela(),
                        $taxa_associado->getAberto()
                    ])) {
                throw new Exception('[INSERIR TAXA-ASSOCIADO] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function alterar(TaxaAssociado $taxa_associado) {
        try {
            $sql = 'UPDATE taxas_associados SET valor_pago = ?, data = ?, parcela = ?, aberto = ? WHERE taxas_id = ? AND associados_id = ?';
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $taxa_associado->getValorPago(),
                        $taxa_associado->getData(),
                        $taxa_associado->getParcela(),
                        $taxa_associado->getAberto(),
                        $taxa_associado->getTaxa()->getId(),
                        $taxa_associado->getAssociado()->getId()
                    ])) {
                throw new Exception('[ALTERAR TAXA-ASSOCIADO] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function listarPorAssociado(Associado $associado) {
        try {
            $sql = "SELECT ta.valor_pago, ta.data, ta.parcela, ta.aberto, t.id AS taxa, t.descricao, t.valor, t.parcelas, t.gratuidade, a.id AS associado, a.nome, a.cpf, a.forma_pagamento"
                    . " FROM taxas_associados ta"
                    . " INNER JOIN associados a ON ta.associados_id = a.id"
                    . " INNER JOIN taxas t ON ta.taxas_id = t.id"
                    . " WHERE a.id = ?";
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $associado->getId()
                    ])) {
                throw new Exception('[LISTAR TAXA-ASSOCIADO] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            $result = [];
            $this->load->model('associado');
            $this->load->model('taxaAssociado');
            $this->load->model('taxa');
            while($r = $stm->fetch(PDO::FETCH_ASSOC)) {
                $taxa_associado = new TaxaAssociado();
                $taxa = new Taxa();
                $taxa_associado->setValorPago($r['valor_pago']);
                $taxa_associado->setData($r['data']);
                $taxa_associado->setParcela($r['parcela']);
                $taxa_associado->setAberto($r['aberto']);
                $taxa->setId($r['taxa']);
                $taxa->setDescricao($r['descricao']);
                $taxa->setValor($r['valor']);
                $taxa->setParcelas($r['parcelas']);
                $taxa->setGratuidade($r['gratuidade']);
                $associado->setNome($r['nome']);
                $associado->setCpf($r['cpf']);
                $associado->setFormaPagamento($r['forma_pagamento']);
                $taxa_associado->setTaxa($taxa);
                $taxa_associado->setAssociado($associado);
                $result[] = $taxa_associado;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function listarPorAssociadoData(Associado $associado, $data_inicio, $data_fim) {
        try {
            $sql = "SELECT ta.valor_pago, ta.data, ta.parcela, ta.aberto, t.id AS taxa, t.descricao, t.valor, t.parcelas, t.gratuidade, a.id AS associado, a.nome, a.cpf, a.forma_pagamento"
                    . " FROM taxas_associados ta"
                    . " INNER JOIN associados a ON ta.associados_id = a.id"
                    . " INNER JOIN taxas t ON ta.taxas_id = t.id"
                    . " WHERE a.id = ?"
                    . " AND ta.data BETWEEN ? AND ?";
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $associado->getId(),
                        $data_inicio,
                        $data_fim
                    ])) {
                throw new Exception('[LISTAR TAXA-ASSOCIADO] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            $result = [];
            $this->load->model('associado');
            $this->load->model('taxaAssociado');
            $this->load->model('taxa');
            while($r = $stm->fetch(PDO::FETCH_ASSOC)) {
                $taxa_associado = new TaxaAssociado();
                $taxa = new Taxa();
                $taxa_associado->setValorPago($r['valor_pago']);
                $taxa_associado->setData($r['data']);
                $taxa_associado->setParcela($r['parcela']);
                $taxa_associado->setAberto($r['aberto']);
                $taxa->setId($r['taxa']);
                $taxa->setDescricao($r['descricao']);
                $taxa->setValor($r['valor']);
                $taxa->setParcelas($r['parcelas']);
                $taxa->setGratuidade($r['gratuidade']);
                $associado->setNome($r['nome']);
                $associado->setCpf($r['cpf']);
                $associado->setFormaPagamento($r['forma_pagamento']);
                $taxa_associado->setTaxa($taxa);
                $taxa_associado->setAssociado($associado);
                $result[] = $taxa_associado;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function listarPorAssociadoTaxa(TaxaAssociado $taxa_associado) {
        try {
            $sql = "SELECT ta.valor_pago, ta.data, ta.parcela, ta.aberto, t.id AS taxa, t.descricao, t.valor, t.parcelas, t.gratuidade, a.id AS associado, a.nome, a.cpf, a.forma_pagamento"
                    . " FROM taxas_associados ta"
                    . " INNER JOIN associados a ON ta.associados_id = a.id"
                    . " INNER JOIN taxas t ON ta.taxas_id = t.id"
                    . " WHERE a.id = ?"
                    . " AND t.id = ?";
            $stm = $this->c->prepare($sql);
            if (!$stm->execute([
                        $taxa_associado->getAssociado()->getId(),
                        $taxa_associado->getTaxa()->getId()
                    ])) {
                throw new Exception('[LISTAR TAXA-ASSOCIADO] Não foi possível completar a operação. ' . $stm->errorInfo()[2]);
            }
            $result = [];
            $this->load->model('associado');
            $this->load->model('taxaAssociado');
            $this->load->model('taxa');
            while($r = $stm->fetch(PDO::FETCH_ASSOC)) {
                $taxa_associado = new TaxaAssociado();
                $taxa = new Taxa();
                $associado = new Associado();
                $taxa_associado->setValorPago($r['valor_pago']);
                $taxa_associado->setData($r['data']);
                $taxa_associado->setParcela($r['parcela']);
                $taxa_associado->setAberto($r['aberto']);
                $taxa->setId($r['taxa']);
                $taxa->setDescricao($r['descricao']);
                $taxa->setValor($r['valor']);
                $taxa->setParcelas($r['parcelas']);
                $taxa->setGratuidade($r['gratuidade']);
                $associado->setId($r['associado']);
                $associado->setNome($r['nome']);
                $associado->setCpf($r['cpf']);
                $associado->setFormaPagamento($r['forma_pagamento']);
                $taxa_associado->setTaxa($taxa);
                $taxa_associado->setAssociado($associado);
                $result[] = $taxa_associado;
            }
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

}
