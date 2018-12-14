<table class="table table-sm">
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
          <button type="button" data-target="<?= base_url('telefones/editar/' . $telefone->getId()); ?>" class="btn btn-outline-primary btn-sm edit-phone">
            <i class="material-icons">edit</i>
          </button>
          <button type="button" data-target="<?= base_url('telefones/excluir/' . $telefone->getId()); ?>" class="btn btn-outline-danger btn-sm delete-phone">
          <i class="material-icons">delete</i>
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
