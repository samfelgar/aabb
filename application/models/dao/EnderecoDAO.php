<?php

require_once 'DAO.php';

class EnderecoDAO extends DAO {

    public function inserir(Endereco $endereco) {
        try {
            $sql = 'insert into enderecos values (null,?,?,?,?,?,?,?,?)';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $endereco->getLogradouro(),
                $endereco->getNumero(),
                $endereco->getBairro(),
                $endereco->getComplemento(),
                $endereco->getCidade(),
                $endereco->getEstado(),
                $endereco->getCep(),
                $endereco->getAssociado()->getId(),
            ));
            if (!$result) {
                throw new Exception('<strong>[INSERIR ENDERECO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function alterar(Endereco $endereco) {
        try {
            $sql = 'update enderecos set logradouro = ?, numero = ?, bairro = ?, complemento = ?, cidade = ?, estado = ?, cep = ? where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $endereco->getLogradouro(),
                $endereco->getNumero(),
                $endereco->getBairro(),
                $endereco->getComplemento(),
                $endereco->getCidade(),
                $endereco->getEstado(),
                $endereco->getCep(),
                $endereco->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[ALTERAR ENDERECO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listar(Associado $associado) {
        try {
            $sql = 'select * from enderecos where associados_id = ?';
            $stmt = $this->c->prepare($sql);
            if (!$stmt->execute(array($associado->getId()))) {
                throw new PDOException('<strong>[LISTAR ENDERECO]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
            }
            $result = array();
            while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->load->model('endereco');
                $endereco = new Endereco();
                $endereco->setId($r['id']);
                $endereco->setLogradouro($r['logradouro']);
                $endereco->setNumero($r['numero']);
                $endereco->setBairro($r['bairro']);
                $endereco->setComplemento($r['complemento']);
                $endereco->setCidade($r['cidade']);
                $endereco->setEstado($r['estado']);
                $endereco->setCep($r['cep']);
                $endereco->setAssociado($associado);
                $result[] = $endereco;
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function listarPorId(Endereco $endereco) {
      try {
        $sql = 'select * from enderecos where id = ?';
        $stmt = $this->c->prepare($sql);
        if (!$stmt->execute(array($endereco->getId()))) {
          throw new PDOException('<strong>[LISTAR ENDERECO POR ID]</strong> Houve um problema no processamento da sua solitação. ' . $stmt->errorInfo()[2]);
        }
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        $endereco->setLogradouro($r['logradouro']);
        $endereco->setNumero($r['numero']);
        $endereco->setBairro($r['bairro']);
        $endereco->setComplemento($r['complemento']);
        $endereco->setCidade($r['cidade']);
        $endereco->setEstado($r['estado']);
        $endereco->setCep($r['cep']);
        return $endereco;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function delete(Endereco $endereco) {
        try {
            $sql = 'delete from enderecos where id = ?';
            $stmt = $this->c->prepare($sql);
            $result = $stmt->execute(array(
                $endereco->getId()
            ));
            if (!$result) {
                throw new Exception('<strong>[EXCLUIR ENDERECO]</strong> Não foi possível completar a operação. ' . $stmt->errorInfo()[2]);
            }
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
