<h3 class="text-primary mt-3">Pesquisar associados</h3>
<table class="table table-hover table-sm dt">
  <thead>
    <th>id</th>
    <th>Nome</th>
    <th>CPF</th>
    <th>Visão geral</th>
    <th>Novo lançamento</th>
  </thead>
  <tbody>
    <?php foreach ($associados as $associado): ?>
      <tr>
        <td><?= $associado->getId(); ?></td>
        <td><?= $associado->getNome(); ?></td>
        <td><?= $associado->getCpf(); ?></td>
        <td><a href="<?= base_url('financeiro/overview/' . $associado->getId()); ?>">Últimos lançamentos</a></td>
        <td><a href="<?= base_url('financeiro/overview/' . $associado->getId()); ?>"></a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
