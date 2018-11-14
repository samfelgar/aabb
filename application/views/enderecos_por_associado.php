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
          <button type="button" data-target="<?= base_url('enderecos/editar/' . $endereco->getId()); ?>" class="btn btn-outline-primary btn-sm edit-address"><span data-feather="edit"></span></button>
          <button type="button" data-target="<?= base_url('enderecos/excluir/' . $endereco->getId()); ?>" class="btn btn-outline-danger btn-sm delete-address"><span data-feather="trash"></span></button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
