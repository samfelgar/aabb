<h3 class="text-primary">Alterar perfil de usuário</h3>
<hr>
<form action="<?= base_url('usuarios/alterar_perfil'); ?>" method="post">
    <div class="row">
        <div class="col-sm-5 form-group">
            <label for="user">Nome</label>
            <input type="hidden" name="id" id="id" value="<?= $usuario->getId(); ?>">
            <input type="text" id="user" name="user" class="form-control text-lowercase" required="" value="<?= $usuario->getUser(); ?>" readonly="">
        </div>
        <div class="col-sm-4 form-group">
            <label for="perfil">Perfil</label>
            <select name="perfil" id="perfil" class="custom-select" required="">
                <?php foreach ($perfis as $perfil): ?>
                    <option value="<?= $perfil->getId(); ?>" <?= ($perfil->getId() == $usuario->getPerfil()->getId()) ? 'selected' : ''; ?>>
                        <?= $perfil->getDescricao(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('usuarios'); ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</form>