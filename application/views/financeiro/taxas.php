<h3 class="text-primary">Administração de taxas</h3>
<a href="<?= base_url('taxas/nova'); ?>" class="btn btn-outline-primary btn-sm">Adicionar taxa</a>
<hr>
<table class="table table-responsive-sm table-sm dt">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Parcelas</th>
            <th>Gratuidade</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($taxas as $taxa): ?>
            <tr>
                <td><?= $taxa->getDescricao(); ?></td>
                <td>R$ <?= $taxa->getValor(true); ?></td>
                <td><?= $taxa->getParcelas(); ?>x</td>
                <td><?= $taxa->getGratuidade(); ?></td>
                <td>
                    <a href="<?= base_url('taxas/alterar/' . $taxa->getId()); ?>" class="btn btn-outline-primary btn-sm">
                        <span class="material-icons">edit</span>
                    </a>
                    <a href="<?= base_url('taxas/excluir/' . $taxa->getId()); ?>" class="btn btn-outline-danger btn-sm confirm">
                        <span class="material-icons">delete</span>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>