<h3 class="text-primary">Consultar CPF</h3>
<form action="<?= base_url('associados/novo'); ?>" method="post">
    <div class="form-row">
        <div class="col-sm form-group">
            <label for="cpf" class="text-muted">Para iniciar o cadastro, informe o CPF desejado no campo abaixo</label>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-4 form-group">
            <input type="text" class="form-control cpf" name="cpf" id="cpf" required="">
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </div>
    </div>
</form>