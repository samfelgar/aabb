<h3 class="text-primary">Perfis do sistema</h3>
<a href="<?= base_url('perfis/novo'); ?>" class="btn btn-sm btn-outline-primary mb-3">Adicionar novo</a>
<table class="table table-hover table-sm dt">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($perfis as $perfil): ?>
        <tr>
            <td><?= $perfil->getDescricao(); ?></td>
            <td>
                <a href="<?= base_url('perfis/alterar/' . $perfil->getId()); ?>" class="btn btn-sm btn-outline-primary">
                    <i class="material-icons">edit</i>
                </a>
                <a href="<?= base_url('perfis/excluir/' . $perfil->getId()); ?>" class="btn btn-sm btn-outline-danger confirm">
                    <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>