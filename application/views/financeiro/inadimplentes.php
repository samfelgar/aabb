<h3 class="text-primary">Inadimplentes de <?= $month . '/' . $year; ?></h3>
<div class="row">
    <div class="col">
        <table class="table table-sm table-hover dt">
            <thead>
                <th>id</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Forma de pagamento</th>
                <th>Plano</th>
            </thead>
            <tbody>
            <?php foreach ($associados as $associado): ?>
                <tr>
                    <td><?= $associado->getId(); ?></td>
                    <td><?= $associado->getNome(); ?></td>
                    <td><?= $associado->getCpf(); ?></td>
                    <td><?= $associado->getFormaPagamento(); ?></td>
                    <td><?= $associado->getPlano()->getDescricao(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="<?= base_url('financeiro/inadimplentes'); ?>" class="btn btn-secondary">Voltar</a>
    </div>
</div>
