<table class="table table-sm">
    <thead>
        <tr>
            <th>Logradouro</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Complemento</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($enderecos as $endereco): ?>
            <tr>
                <td><?= $endereco->getLogradouro(); ?></td>
                <td><?= $endereco->getNumero(); ?></td>
                <td><?= $endereco->getBairro(); ?></td>
                <td><?= $endereco->getComplemento(); ?></td>
                <td>
                    <button type="button" data-target="<?= base_url('enderecos/editar/' . $endereco->getId()); ?>" class="btn btn-outline-primary btn-sm edit-address">
                        <i class="material-icons">edit</i>
                    </button>
                    <button type="button" data-target="<?= base_url('enderecos/excluir/' . $endereco->getId()); ?>" class="btn btn-outline-danger btn-sm delete-address">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
