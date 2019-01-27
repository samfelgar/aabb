<h3 class="text-primary">Novo usuário</h3>
<hr>
<form action="<?= base_url('usuarios/salvar'); ?>" method="post">
    <div class="row">
        <div class="col-sm-5 form-group">
            <label for="user">Nome *</label>
            <input type="text" id="user" name="user" class="form-control text-lowercase" required="">
        </div>
        <div class="col-sm-4 form-group">
            <label for="perfil">Perfil</label>
            <select name="perfil" id="perfil" class="custom-select" required="">
                <?php foreach ($perfis as $perfil): ?>
                    <option value="<?= $perfil->getId(); ?>"><?= $perfil->getDescricao(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 form-group">
            <label for="password">Senha **</label>
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
<p class="text-muted">* O nome de usuário não poderá ser alterado após sua definição. <br>
    ** A senha deve possuir, no mínimo, 6 caracteres.
</p>