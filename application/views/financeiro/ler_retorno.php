<div class="modal fade" id="warning-modal" tabindex="-1" role="dialog" aria-labelledby="warning-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>1) Somente serão gravados no sistema os valores equivalentes ao plano do associado, 
                    demais valores deverão ser cadastrados individualmente. <br>
                    2) Somente serão gravados os registros cujo código de retorno for igual a 00 - Débito efetuado. <br>
                    3) A identificação do cliente é a mesma informada no aplicativo Débito Automático (Banco do Brasil).
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Entendi</button>
            </div>
        </div>
    </div>
</div>
<h3 class="text-primary">Lançamentos do arquivo de retorno</h3>
<hr>
<form action="<?= base_url('financeiro/gravar_lancamentos_retorno/'); ?>" method="post" class="dt-form">
    <p class="text-muted"><small>1) Somente serão gravados no sistema os valores equivalentes ao plano do associado, 
            demais valores deverão ser cadastrados individualmente. <br>
            2) Somente serão gravados os registros cujo código de retorno for igual a 00 - Débito efetuado. <br>
            3) A identificação do cliente é a mesma informada no aplicativo Débito Automático (Banco do Brasil).</small></p>
    <div class="row">
        <div class="form-group col-sm">
            <button type="submit" class="btn btn-primary">Gerar lançamentos</button>
            <a href="<?= base_url('financeiro/upload_retorno'); ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm d-flex">
            <span class="ml-auto">Total de lançamentos: <?= count($registros) - 2; ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm form-group">
            <table class="table table-responsive-sm table-sm">
                <thead>
                <th>Identificação do cliente</th>
                <th>Agência</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Código de retorno</th>
                </thead>
                <tbody>     
                    <?php foreach ($registros as $registro): ?>
                        <?php if (get_class($registro) != 'RegistroF') continue; ?>
                        <tr class="<?= ($registro->getF07() != '00') ? 'bg-danger text-white' : ''; ?>">
                            <td>
                                <input type="hidden" name="identificacao[]" value="<?= $registro->getF04(true); ?>">
                                <?= $registro->getF04(true); ?>
                            </td>
                            <td>
                                <input type="hidden" name="agencia[]" value="<?= $registro->getF03(); ?>">
                                <?= $registro->getF03(); ?>
                            </td>
                            <td>
                                <input type="hidden" name="valor[]" value="<?= $registro->getF06(); ?>">
                                R$ <?= $registro->getF06(true); ?>
                            </td>
                            <td>
                                <input type="hidden" name="data[]" value="<?= $registro->getF05(); ?>">
                                <?= $registro->getF05(true); ?>
                            </td>
                            <td>
                                <input type="hidden" name="retorno[]" value="<?= $registro->getF07(); ?>">
                                <?= $registro->getF07() . ' - ' . RegistroF::CODIGO_RETORNO[$registro->getF07()]; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm">
            <button type="submit" class="btn btn-primary">Gerar lançamentos</button>
            <a href="<?= base_url('financeiro/upload_retorno'); ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</form>