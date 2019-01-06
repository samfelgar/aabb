<h3 class="text-primary">Menus do sistema</h3>
<a href="<?= base_url('menus/novo'); ?>" class="btn btn-sm btn-outline-primary mb-3">Adicionar novo</a>
<table class="table table-sm table-hover dt">
    <thead>
    <th>id</th>
    <th>Descrição</th>
    <th>URL</th>
    <th>Menu pai</th>
    <th>Opções</th>
</thead>
<tbody>
    <?php foreach ($links as $link): ?>
        <tr>
            <td>
                <?= $link->getId(); ?>
            </td>
            <td>
                <?= $link->getDescricao(); ?>
            </td>
            <td>
                <?= $link->getUrl(); ?>
            </td>
            <td>
                <?= $link->getMenu()->getId(); ?>
            </td>
            <td>
                <a href="<?= base_url('menus/alterar/' . $link->getId()); ?>" class="btn btn-sm btn-outline-primary">
                    <i class="material-icons">edit</i>
                </a>
                <a href="<?= base_url('menus/excluir/' . $link->getId()); ?>" class="btn btn-sm btn-outline-danger confirm">
                    <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>