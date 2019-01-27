<h3 class="text-primary">Redefinir senha</h3>
<hr>
<form action="<?= base_url('usuarios/redefinir_senha'); ?>" method="post">
    <div class="row">
        <div class="col-sm-5 form-group">
            <label for="user">Nome</label>
            <input type="hidden" id="id" name="id" value="<?= $usuario->getId(); ?>">
            <input type="text" id="user" name="user" class="form-control text-lowercase" required="" readonly="" value="<?= $usuario->getUser(); ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 form-group">
            <label for="password">Senha *</label>
            <input type="password" id="password" name="password" class="form-control" minlength="6" required="">
        </div>
        <div class="col-sm-4 form-group">
            <label for="password-confirm">Confirme a senha</label>
            <input type="password" id="password-confirm" name="password-confirm" class="form-control" minlength="6" required="">
        </div>
    </div>
    <div class="row">
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('usuarios'); ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</form>
<p class="text-muted">* A senha deve possuir, no mínimo, 6 caracteres.</p>