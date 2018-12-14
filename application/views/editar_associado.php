<div class="modal fade" id="add-modal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carregando...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm add-body">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display:none">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="d-flex align-items-center">
    <h3 class="text-primary mr-auto">Alterar associado</h3>
    <div>
        <button type="button" id="desativar-associado" class="btn btn-outline-danger btn-sm">Desativar associado</button>
    </div>
</div>
<hr>
<form method="post" action="<?= base_url('associados/salvar/') . $associado->getId(); ?>">
    <input type="hidden" name="associado-id" id="associado-id" value="<?=$associado->getId();?>">
    <div class="form-row">
        <div class="col-sm form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?=$associado->getNome();?>" required="">
        </div>
        <div class="col-sm form-group">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" class="form-control cpf" value="<?=$associado->getCpf();?>" required="">
        </div>
        <div class="col-sm form-group">
            <label for="rg">RG</label>
            <input type="text" name="rg" id="rg" class="form-control" value="<?=$associado->getRg();?>" required="">
        </div>
        <div class="col-sm form-group">
            <label for="estado-civil">Estado civil</label>
            <select name="estado-civil" id="estado-civil" class="form-control" required="">
                <option value="solteiro" <?=($associado->getEstadoCivil() == 'solteiro') ? 'selected' :
                    '';?>>Solteiro(a)</option>
                <option value="casado" <?=($associado->getEstadoCivil() == 'casado') ? 'selected' : '';?>>Casado(a)</option>
                <option value="divorciado" <?=($associado->getEstadoCivil() == 'divorciado') ? 'selected' :
                    '';?>>Divorciado(a)</option>
                <option value="viuvo" <?=($associado->getEstadoCivil() == 'viuvo') ? 'selected' : '';?>>Viúvo(a)</option>
                <option value="separado" <?=($associado->getEstadoCivil() == 'separado') ? 'selected' :
                    '';?>>Separado(a)</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= $associado->getEmail(); ?>">
        </div>
        <div class="col-sm form-group">
            <label for="nascimento">Data de nascimento</label>
            <input type="text" name="nascimento" id="nascimento" class="form-control date" value="<?= $associado->getNascimento(true); ?>" required="">
        </div>
        <div class="col-sm form-group">
            <label for="data-associacao">Membro desde</label>
            <input type="text" name="data-associacao" id="data-associacao" class="form-control date" value="<?= $associado->getDataAssociacao(true); ?>" required="">
        </div>
        <div class="col-sm form-group">
            <label for="plano">Plano</label>
            <select name="plano" id="plano" class="form-control" required="">
                <?php foreach ($planos as $plano): ?>
                <option value="<?= $plano->getId(); ?>" <?=($associado->getPlano()->getId() == $plano->getId()) ? 'selected' : '';?>>
                    <?=$plano->getDescricao();?>
                </option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <label for="agencia">Agência</label>
            <input type="text" name="agencia" id="agencia" class="form-control agencia" value="<?=$associado->getAgencia();?>">
        </div>
        <div class="col-sm form-group">
            <label for="conta">Conta</label>
            <input type="text" name="conta" id="conta" class="form-control conta" value="<?=$associado->getConta();?>">
        </div>
        <div class="col-sm form-group">
            <label for="tipo-conta">Tipo de conta</label>
            <select name="tipo-conta" id="tipo-conta" class="form-control">
                <option value="corrente" <?=($associado->getTipoConta() == 'corrente') ? 'selected' : '';?>>Corrente</option>
                <option value="poupanca" <?=($associado->getTipoConta() == 'poupanca') ? 'selected' : '';?>>Poupança</option>
            </select>
        </div>
        <div class="col-sm form-group">
            <label for="forma-pagamento">Forma de pagamento</label>
            <select name="forma-pagamento" id="forma-pagamento" class="form-control" required="">
                <option value="conta" <?=($associado->getFormaPagamento() == 'conta') ? 'selected' : '';?>>Débito em conta</option>
                <option value="boleto" <?=($associado->getFormaPagamento() == 'boleto') ? 'selected' : '';?>>Boleto</option>
                <option value="cartao" <?=($associado->getFormaPagamento() == 'cartao') ? 'selected' : '';?>>Cartão de crédito</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-4 form-group">
            <label>Telefones</label>
            <div class="phone-table"></div>
            <div class="row">
                <div class="col-sm form-group">
                    <button type="button" class="btn btn-outline-primary btn-sm" id="adicionar-telefone" data-associado="<?=$associado->getId();?>">Adicionar telefone</button>
                </div>
            </div>
        </div>
        <div class="col-sm form-group">
            <label>Endereços</label>
            <div class="address-table"></div>
            <div class="row">
                <div class="col-sm form-group">
                    <button type="button" class="btn btn-outline-primary btn-sm" id="adicionar-endereco" data-associado="<?=$associado->getId();?>">Adicionar endereço</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <label>Anexar documentos</label>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($documentos as $documento): ?>
                    <tr>
                        <td>
                            <?=$documento->getTipoDocumento()->getDescricao();?>
                        </td>
                        <td>
                            <a href="<?=base_url($documento->getPath());?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="material-icons">search</i>
                            </a>
                            <a href="<?=base_url('documentos/excluir/' . $documento->getId() . '/?from=associados&fromId=' . $associado->getId() . '&path=' . $documento->getPath());?>" class="btn btn-sm btn-outline-danger confirm">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <a href="<?=base_url('documentos/novo/?from=associados&id=' . $associado->getId());?>" class="btn btn-sm btn-outline-primary">Novo documento</a>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <label id="dependentes">Dependentes</label>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nascimento</th>
                        <th>CPF</th>
                        <th>Parentesco</th>
                        <th>Documentos</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dependentes as $dependente): ?>
                    <tr>
                        <td>
                            <?=$dependente->getNome();?>
                        </td>
                        <td>
                            <?=$dependente->getNascimento(true);?>
                        </td>
                        <td>
                            <?=$dependente->getCpf();?>
                        </td>
                        <td>
                            <?=$dependente->getParentesco();?>
                        </td>
                        <td>
                            <button type="button" data-dependente="<?=$dependente->getId();?>" class="btn btn-sm btn-outline-primary">
                                <i class="material-icons">folder_open</i>
                            </button>
                        </td>
                        <td>
                            <a href="<?=base_url('dependentes/editar/' . $dependente->getId() . '/?id=' . $associado->getId());?>" class="btn btn-outline-primary btn-sm">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="<?=base_url('dependentes/excluir/' . $dependente->getId() . '/?id=' . $associado->getId());?>" class="btn btn-outline-danger btn-sm confirm">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm form-group">
                    <a class="btn btn-outline-primary btn-sm" id="adicionar-dependente" href="<?=base_url('dependentes/novo/?id=' . $associado->getId());?>">Adicionar dependente</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
            <a href="<?=base_url('associados/ver/' . $associado->getId());?>" class="btn btn-outline-secondary">Voltar</a>
        </div>
    </div>
</form>