<div class="modal fade" id="loading-modal" tabindex="-1" role="dialog">
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
                    <div class="col form-group loading text-center">

                    </div>
                </div>
                <div class="row">
                    <div class="col form-group text-center" id="nova-foto">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
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
<h3 class="text-primary">
    <?= $associado->getNome(); ?>
</h3>
<a href="<?= base_url('associados/imprimir/' . $associado->getId()); ?>" class="btn btn-sm btn-outline-primary" target="_blank">Imprimir</a>
<hr>
<form>
    <div class="form-row">
        <div class="col-sm-4 overlay text-center form-group">
            <?php if (empty($associado->getPhoto())): ?>
                <img src="<?= base_url('assets/images/user.png'); ?>" class="rounded overlay-empty-image" alt="Sem foto">
            <?php else: ?>
                <img src="<?= $associado->getPhoto(true); ?>" class="rounded img-fluid overlay-image" alt="">
            <?php endif; ?>
            <div class="overlay-content">
                <a class="btn btn-primary" href="<?= base_url('fotos/alterar/associado/' . $associado->getId()); ?>">
                    <i class="material-icons">camera_alt</i> capturar nova foto
                </a>
            </div>
        </div>
        <div class="col-sm">
            <div class="form-row">
                <div class="col-sm form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control cpf" value="<?= $associado->getCpf(); ?>" readonly="">
                </div>
                <div class="col-sm form-group">
                    <label for="rg">RG</label>
                    <input type="text" name="rg" id="rg" class="form-control" value="<?= $associado->getRg(); ?>" readonly="">
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm form-group">
                    <label for="estado-civil">Estado civil</label>
                    <select name="estado-civil" id="estado-civil" class="form-control" disabled="">
                        <option value="solteiro" <?= ($associado->getEstadoCivil() == 'solteiro') ? 'selected' : ''; ?>>Solteiro(a)</option>
                        <option value="casado" <?= ($associado->getEstadoCivil() == 'casado') ? 'selected' : ''; ?>>Casado(a)</option>
                        <option value="divorciado" <?= ($associado->getEstadoCivil() == 'divorciado') ? 'selected' : ''; ?>>Divorciado(a)</option>
                        <option value="viuvo" <?= ($associado->getEstadoCivil() == 'viuvo') ? 'selected' : ''; ?>>Viúvo(a)</option>
                        <option value="separado" <?= ($associado->getEstadoCivil() == 'separado') ? 'selected' : ''; ?>>Separado(a)</option>
                    </select>
                </div>
                <div class="col-sm form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $associado->getEmail(); ?>" readonly="">
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm form-group">
                    <label for="nascimento">Data de nascimento</label>
                    <input type="text" name="nascimento" id="nascimento" class="form-control" value="<?= $associado->getNascimento(true); ?>" readonly="">
                </div>
                <div class="col-sm form-group">
                    <label for="data-associacao">Membro desde</label>
                    <input type="text" name="data-associacao" id="data-associacao" class="form-control" value="<?= $associado->getDataAssociacao(true); ?>" readonly="">
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <label for="plano">Plano</label>
            <select name="plano" id="plano" class="form-control" disabled="">
                <?php foreach ($planos as $plano): ?>
                    <option value="<?= $plano->getId(); ?>" <?= ($associado->getPlano()->getId() == $plano->getId()) ? 'selected' : ''; ?>>
                        <?= $plano->getDescricao(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm form-group">
            <label for="agencia">Agência</label>
            <input type="text" name="agencia" id="agencia" class="form-control" value="<?= $associado->getAgencia(); ?>" readonly="">
        </div>
        <div class="col-sm form-group">
            <label for="conta">Conta</label>
            <input type="text" name="conta" id="conta" class="form-control" value="<?= $associado->getConta(); ?>" readonly="">
        </div>
        <div class="col-sm form-group">
            <label for="tipo-conta">Tipo de conta</label>
            <select name="tipo-conta" id="tipo-conta" class="form-control" disabled="">
                <option value="corrente" <?= ($associado->getTipoConta() == 'corrente') ? 'selected' : ''; ?>>Corrente</option>
                <option value="poupanca" <?= ($associado->getTipoConta() == 'poupanca') ? 'selected' : ''; ?>>Poupança</option>
            </select>
        </div>
        <div class="col-sm form-group">
            <label for="forma-pagamento">Forma de pagamento</label>
            <select name="forma-pagamento" id="forma-pagamento" class="form-control" disabled="">
                <option value="conta" <?= ($associado->getFormaPagamento() == 'conta') ? 'selected' : ''; ?>>Débito em conta</option>
                <option value="boleto" <?= ($associado->getFormaPagamento() == 'boleto') ? 'selected' : ''; ?>>Boleto</option>
                <option value="cartao" <?= ($associado->getFormaPagamento() == 'cartao') ? 'selected' : ''; ?>>Cartão de crédito</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-4 form-group">
            <label>Telefones</label>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>DDD</th>
                        <th>Número</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($telefones as $telefone): ?>
                        <tr>
                            <td>
                                <?= $telefone->getDdd(); ?>
                            </td>
                            <td>
                                <?= $telefone->getTelefone(); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-sm form-group">
            <label>Endereços</label>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Logradouro</th>
                        <th>Número</th>
                        <th>Complemento</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enderecos as $endereco): ?>
                        <tr>
                            <td>
                                <?= $endereco->getLogradouro(); ?>
                            </td>
                            <td>
                                <?= $endereco->getNumero(); ?>
                            </td>
                            <td>
                                <?= $endereco->getComplemento(); ?>
                            </td>
                            <td>
                                <?= $endereco->getBairro(); ?>
                            </td>
                            <td>
                                <?= $endereco->getCidade(); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <label>Ver documentos</label>
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
                                <?= $documento->getTipoDocumento()->getDescricao(); ?>
                            </td>
                            <td>
                                <a href="<?= base_url($documento->getPath()); ?>" target="_blank" class="btn btn-sm btn-primary">Visualizar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <label>Dependentes</label>
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nascimento</th>
                        <th>CPF</th>
                        <th>Parentesco</th>
                        <th>Documentos</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dependentes as $dependente): ?>
                        <tr>
                            <td>
                                <?= $dependente->getNome(); ?>
                            </td>
                            <td>
                                <?= $dependente->getNascimento(true); ?>
                            </td>
                            <td>
                                <?= $dependente->getCpf(); ?>
                            </td>
                            <td>
                                <?= $dependente->getParentesco(); ?>
                            </td>
                            <td>
                                <button type="button" data-dependente="<?= $dependente->getId(); ?>" data-edit="false" class="btn btn-sm btn-outline-primary">
                                    <i class="material-icons">folder_open</i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-primary btn-sm load-photo" data-dependente-id="<?= $dependente->getId(); ?>">
                                    <i class="material-icons">photo_camera</i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row no-print">
        <div class="col-sm form-group">
            <a href="<?= base_url('associados/editar/' . $associado->getId()); ?>" class="btn btn-primary">Editar</a>
            <a href="<?= base_url('associados'); ?>" class="btn btn-outline-secondary">Voltar</a>
        </div>
    </div>
</form>