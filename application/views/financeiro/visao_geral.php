<h3 class="text-primary">Visão geral de <?= $associado->getNome(); ?></h3>
<hr>
<div class="row form-group">
  <div class="col">
    <h5 class="text-primary">Últimos 12 meses</h5>
    <table class="table table-sm table-hover">
      <thead>
        <tr>
          <th>Mês</th>
          <th>Ano</th>
          <th>Pagamento</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($lancamentos as $lancamento): ?>
          <?php
          $date = new DateTime($lancamento[0]);
          ?>
          <tr class="<?= (!$lancamento[1]) ? 'bg-danger text-white' : ''; ?>">
            <td><?= Lancamento::MONTHS[$date->format('m')]; ?></td>
            <td><?= $date->format('Y'); ?></td>
            <td><?= ($lancamento[1]) ? 'Pago' : 'Não pago'; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="col">
    <h5 class="text-primary">Novo lancamento</h5>
    <form action="<?= base_url('financeiro/salvar'); ?>" method="post" id="form-lancamentos">
      <input type="hidden" name="associado-id" id="associado-id" value="<?= $associado->getId(); ?>">
      <input type="hidden" name="plano-valor" value="<?= $associado->getPlano()->getValor(); ?>">
      <div class="row form-group">
        <div class="col">
          <label for="ano">Selecione o ano</label>
          <select class="form-control" name="ano" id="ano" required>
            <?php
            $dt = new DateTime();
            ?>
            <?php for ($i = 0; $i < 10; $i++): ?>
              <option value="<?= $dt->format('Y')?>"><?= $dt->format('Y')?></option>
              <?php
              $dt->modify('-1 year');
              ?>
            <?php endfor; ?>
          </select>
        </div>
      </div>
      <div class="chk-lancamento"></div>
    </form>
  </div>
</div>
<div class="row form-group">
  <div class="col">
    <button type="button" class="btn btn-secondary go-back">Voltar</button>
  </div>
</div>
