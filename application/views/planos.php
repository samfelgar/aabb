<h3 class="text-primary">Administração de planos de associados</h3>
<a href="<?= base_url('planos/novo'); ?>" class="btn btn-outline-primary btn-sm mb-3">Adicionar plano</a>
<table class="table dt">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($planos as $plano): ?>
            <tr>
                <td><?= $plano->getDescricao(); ?></td>
                <td>R$ <?= $plano->getValor(true); ?></td>
                <td>
                    <a href="<?= base_url('planos/alterar/' . $plano->getId()); ?>" class="btn btn-sm btn-outline-primary">
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="<?= base_url('planos/excluir/' . $plano->getId()); ?>" class="btn btn-sm btn-outline-danger confirm">
                        <i class="material-icons">delete</i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
