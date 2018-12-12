<h3 class="text-primary mt-3">Lista de associados</h3>
<hr>
<div class="d-flex">
  <a href="<?= base_url('associados/novo'); ?>" class="btn btn-outline-primary btn-sm mb-3">Adicionar associado</a>
  <div class="export-btn mb-3 ml-auto"></div>
</div>
<table class="table table-sm table-hover dt">
  <thead>
    <tr>
      <th>Nome</th>
      <th>CPF</th>
      <th>Agência</th>
      <th>Conta</th>
      <th>Forma de pagamento</th>
      <th>Plano</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($associados as $associado): ?>
      <tr>
        <td><?= $associado->getNome(); ?></td>
        <td><?= $associado->getCpf(); ?></td>
        <td><?= $associado->getAgencia(); ?></td>
        <td><?= $associado->getConta(); ?></td>
        <td class="text-capitalize"><?= $associado->getFormaPagamento(); ?></td>
        <td><?= $associado->getPlano()->getDescricao(); ?></td>
        <td>
          <a href="<?= base_url('associados/ver/') . $associado->getId(); ?>" title="Ver mais">Detalhes</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
