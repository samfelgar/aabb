<h3 class="text-primary">Alterar senha</h3>
<hr>
<p class="text-muted">Sua nova senha deverá ter no mínimo 6 caracteres e pode conter letras e números.</p>
<form action="<?= base_url('usuarios/salvar_senha_propria'); ?>" method="post">
    <div class="row">
        <div class="col-sm-4 form-group">
            <label for="current-password">Senha atual</label>
            <input type="password" id="current-password" name="current-password" class="form-control" minlength="6" required="">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 form-group">
            <label for="new-password">Informe a nova senha</label>
            <input type="password" id="new-password" name="new-password" class="form-control" minlength="6" required="">
        </div>
        <div class="col-sm-4 form-group">
            <label for="new-password-confirmation">Confirme a nova senha</label>
            <input type="password" id="new-password-confirmation" name="new-password-confirmation" class="form-control" minlength="6" required="">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 form-group">
            <button class="btn btn-primary" type="submit">Alterar</button>
            <button type="button" class="btn btn-secondary go-back">Voltar</button>
        </div>
    </div>
</form>