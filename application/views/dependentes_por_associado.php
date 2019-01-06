<table class="table table-sm table-hover">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Nascimento</th>
            <th>CPF</th>
            <th>Parentesco</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dependentes as $dependente): ?>
            <tr>
                <td><?= $dependente->getNome(); ?></td>
                <td><?= $dependente->getNascimento(true); ?></td>
                <td><?= $dependente->getCpf(); ?></td>
                <td><?= $dependente->getParentesco(); ?></td>
                <td>
                    <button type="button" data-target="<?= base_url('dependentes/editar/' . $dependente->getId()); ?>" class="btn btn-outline-primary btn-sm edit-dependente"><span data-feather="edit"></span></button>
                    <button type="button" data-target="<?= base_url('dependentes/excluir/' . $dependente->getId()); ?>" class="btn btn-outline-danger btn-sm delete-dependente"><span data-feather="trash"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
