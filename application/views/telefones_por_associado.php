<table class="table table-sm ">
  <thead>
    <tr>
      <th>DDD</th>
      <th>Número</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($telefones as $telefone): ?>
      <tr>
        <td><?= $telefone->getDdd(); ?></td>
        <td><?= $telefone->getTelefone(); ?></td>
        <td>
          <button type="button" data-target="<?= base_url('telefones/editar/' . $telefone->getId()); ?>" class="btn btn-outline-primary btn-sm edit-phone"><span data-feather="edit"></span></button>
          <button type="button" data-target="<?= base_url('telefones/excluir/' . $telefone->getId()); ?>" class="btn btn-outline-danger btn-sm delete-phone"><span data-feather="trash"></span></button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
