<h3 class="text-primary">Relação de associados</h3>
<hr>
<div class="mb-3">
    <button type="button" class="btn btn-sm btn-outline-primary print no-print">Imprimir</button>
</div>
<p>
    Total de associados: <?= $totalAssociados; ?> <br>
    Total de dependentes: <?= $totalDependentes; ?>
</p>
<table class="table table-sm dt-details">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Forma de pagamento</th>
            <th>Plano</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($relacao as $item): ?>
        <tr>
            <td>
                <?= $item[0]->getNome(); ?>
            </td>
            <td>
                <?= $item[0]->getCpf(); ?>
            </td>
            <td class="text-capitalize">
                <?= $item[0]->getFormaPagamento(); ?>
            </td>
            <td>
                <?= $item[0]->getPlano()->getDescricao(); ?>
            </td>
        </tr>
        <?php if (count($item[1]) > 0): ?>
        <tr>
            <td colspan="4">
                <table class="table-hover ml-5">
                    <thead>
                        <tr>
                            <th>Dependente</th>
                            <th>CPF</th>
                            <th>Relacionamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item[1] as $dependente): ?>
                        <tr>
                            <td><?= $dependente->getNome(); ?></td>
                            <td><?= $dependente->getCpf(); ?></td>
                            <td><?= $dependente->getParentesco(); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
</table>