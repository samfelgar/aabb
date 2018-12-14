<h3 class="text-primary">Selecione o período desejado</h3>
<form action="<?= base_url('financeiro/inadimplentes/visualizar'); ?>" method="post">
<div class="row form-group">
    <div class="col-2">
        <input type="text" id="ano" name="ano" value="<?= $year; ?>" class="form-control-plaintext" readonly>
    </div>
    <div class="col-3">
        <select name="mes" id="mes" class="form-control">
            <?php foreach (array_reverse(Lancamento::MONTHS, true) as $k => $v): ?>
                <option value="<?= $k; ?>"><?= $v; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="row form-group">
    <div class="col">
        <button type="submit" class="btn btn-primary">Continuar</button>
    </div>
</div>
</form>