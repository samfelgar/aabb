<div class="row form-group">
    <div class="col">
        <?php foreach (Lancamento::MONTHS as $num => $mes): ?>
            <?php
            $pg = false;
            foreach ($checkboxes as $chk) {
                if ($chk->getMonth() == $num) {
                    $pg = true;
                }
            }
            ?>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="meses[]" id="<?= $mes; ?>" value="<?= $num; ?>" <?= ($pg) ? 'disabled' : ''; ?> <?= ($pg) ? 'checked' : ''; ?>>
                <label class="custom-control-label" for="<?= $mes; ?>"><?= $mes; ?></label>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="row form-group">
    <div class="col">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-secondary">Limpar</button>
    </div>
</div>
