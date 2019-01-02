<h3 class="text-primary">Upload de arquivo de retorno (.RET)</h3>
<hr>
<form action="<?= base_url('financeiro/ler_retorno'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-row form-group">
        <div class="col">
            <label for="document">Selecione o documento desejado</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
            <input type="file" class="form-control-file" name="document" id="document" accept="text/plain,.ret">
        </div>
    </div>
    <div class="form-row form-group">
        <div class="col">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="button" class="btn btn-secondary go-back">Voltar</button>
        </div>
    </div>
</form>
<small class="text-muted">O arquivo deve ter no máximo 2 MB.</small>
<br>
<small class="text-muted">São aceitas as seguintes extensões: RET e TXT.</small>