<h3 class="text-primary">Resultado do processamento do arquivo .RET</h3>
<button type="button" class="btn btn-outline-primary btn-sm print no-print">Imprimir</button>
<hr>
<div class="row">
    <div class="col-sm form-group">
        <h4 class="text-secondary font-weight-bold">Processados com sucesso: <?= count($resultados[0]); ?></h4>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <table class="table table-sm table-responsive-lg table-hover">
            <thead>
                <th>#</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Agência</th>
                <th>Conta</th>
                <th>Data</th>
                <th>Valor</th>
            </thead>
            <tbody>
                <?php if (count($resultados[0]) > 0) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($resultados[0] as $lancamento): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $lancamento->getAssociado()->getNome(); ?></td>
                            <td><?= $lancamento->getAssociado()->getCpf(); ?></td>
                            <td><?= $lancamento->getAssociado()->getAgencia(); ?></td>
                            <td><?= $lancamento->getAssociado()->getConta(); ?></td>
                            <td><?= (new DateTime($lancamento->getData()))->format('d/m/Y'); ?></td>
                            <td>R$ <?= number_format($lancamento->getValor(), 2, ',', '.'); ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <h4 class="text-secondary font-weight-bold">Não pagos: <?= count($resultados[1]); ?></h4>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <table class="table table-sm table-hover">
            <thead>
                <th>#</th>
                <th>Conta</th>
                <th>Agência</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Razão de recusa</th>
            </thead>
            <tbody>
                <?php if (count($resultados[1]) > 0) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($resultados[1] as $registro): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $registro->getF04(); ?></td>
                            <td><?= $registro->getF03(); ?></td>
                            <td><?= (new DateTime($registro->getF05()))->format('d/m/Y'); ?></td>
                            <td>R$ <?= $registro->getF06(true); ?></td>
                            <td><?= RegistroF::CODIGO_RETORNO[$registro->getF07()]; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <h4 class="text-secondary font-weight-bold">Valores incorretos: <?= count($resultados[2]); ?></h4>
        <p class="text-muted"><small>Os valores abaixo NÃO são salvos pelo sistema, devendo ser incluídos manualmente.</small></p>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <table class="table table-sm table-hover">
            <thead>
                <th>#</th>
                <th>Conta</th>
                <th>Agência</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Mensagem de retorno</th>
            </thead>
            <tbody>
                <?php if (count($resultados[2]) > 0) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($resultados[2] as $registro): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $registro->getF04(); ?></td>
                            <td><?= $registro->getF03(); ?></td>
                            <td><?= (new DateTime($registro->getF05()))->format('d/m/Y'); ?></td>
                            <td>R$ <?= $registro->getF06(true); ?></td>
                            <td><?= RegistroF::CODIGO_RETORNO[$registro->getF07()]; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <h4 class="text-secondary font-weight-bold">Associados não encontrados: <?= count($resultados[3]); ?></h4>
        <p class="text-muted"><small>Os lançamentos abaixo não foram registrados pelo sistema, uma vez que não foi possível identificar o associado.</small></p>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <table class="table table-sm table-hover">
            <thead>
                <th>#</th>
                <th>Conta</th>
                <th>Agência</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Mensagem de retorno</th>
            </thead>
            <tbody>
                <?php if (count($resultados[3]) > 0) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($resultados[3] as $registro): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $registro->getF04(); ?></td>
                            <td><?= $registro->getF03(); ?></td>
                            <td><?= (new DateTime($registro->getF05()))->format('d/m/Y'); ?></td>
                            <td>R$ <?= $registro->getF06(true); ?></td>
                            <td><?= RegistroF::CODIGO_RETORNO[$registro->getF07()]; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <h4 class="text-secondary font-weight-bold">Associados desativados: <?= count($resultados[5]); ?></h4>
        <p class="text-muted"><small>Os lançamentos abaixo não foram registrados pelo sistema, pois o associado está desativado.</small></p>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <table class="table table-sm table-hover">
            <thead>
                <th>#</th>
                <th>Conta</th>
                <th>Agência</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Mensagem de retorno</th>
            </thead>
            <tbody>
                <?php if (count($resultados[5]) > 0) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($resultados[5] as $registro): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $registro->getF04(); ?></td>
                            <td><?= $registro->getF03(); ?></td>
                            <td><?= (new DateTime($registro->getF05()))->format('d/m/Y'); ?></td>
                            <td>R$ <?= $registro->getF06(true); ?></td>
                            <td><?= RegistroF::CODIGO_RETORNO[$registro->getF07()]; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <h4 class="text-secondary font-weight-bold">Lançamentos duplicados: <?= count($resultados[4]); ?></h4>
        <p class="text-muted"><small>Os lançamentos abaixo já foram cadastrados anteriormente. Nenhuma alteração foi feita.</small></p>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <table class="table table-sm table-hover">
            <thead>
                <th>#</th>
                <th>Conta</th>
                <th>Agência</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Mensagem de retorno</th>
            </thead>
            <tbody>
                <?php if (count($resultados[4]) > 0) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($resultados[4] as $registro): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $registro->getF04(); ?></td>
                            <td><?= $registro->getF03(); ?></td>
                            <td><?= (new DateTime($registro->getF05()))->format('d/m/Y'); ?></td>
                            <td>R$ <?= $registro->getF06(true); ?></td>
                            <td><?= RegistroF::CODIGO_RETORNO[$registro->getF07()]; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
