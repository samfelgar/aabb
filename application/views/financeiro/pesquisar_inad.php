<h3 class="text-primary">Selecione o período desejado</h3>
<form action="<?= base_url('financeiro/inadimplentes/visualizar'); ?>" method="get">
<div class="row">
    <div class="col-sm-2 form-group">
        <select name="ano" id="ano" class="custom-select">
            <?php for ($i = 0; $i < 10; $i++): ?>
            <option value="<?= $year; ?>"><?= $year; ?></option>
            <?php $year--; ?>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-sm-3 form-group">
        <select name="mes" id="mes" class="custom-select">
            <?php foreach (array_reverse(Lancamento::MONTHS, true) as $k => $v): ?>
                <option value="<?= $k; ?>"><?= $v; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm form-group">
        <button type="submit" class="btn btn-primary">Continuar</button>
    </div>
</div>
</form>