<h3 class="text-primary mt-3">Upload de documento</h3>
<hr>
<form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
    <div class="form-row form-group">
        <div class="col">
            <label for="document">Selecione o documento desejado</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="4194304" />
            <input type="file" class="form-control-file" name="document" id="document" accept="image/png,image/jpg,image/jpeg,application/pdf">
        </div>
        <div class="col">
            <label for="tipo-documento">Tipo de documento</label>
            <select name="tipo-documento" id="tipo-documento" class="custom-select">
                <?php foreach ($tipoDocumento as $tipo): ?>
                <option value="<?= $tipo->getId(); ?>"><?= $tipo->getDescricao(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-row form-group">
        <div class="col">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</form>
<small class="text-muted">O arquivo deve ter no máximo 4 MB.</small>
<br>
<small class="text-muted">São aceitas as seguintes extensões: JPG, JPEG, PNG e PDF.</small>