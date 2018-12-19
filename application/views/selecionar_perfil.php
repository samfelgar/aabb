<h3 class="text-primary">Escolha o perfil desejado</h3>
<form action="<?= base_url('acessos/visualizar/'); ?>" method="get">
    <div class="row">
        <div class="col-sm-5 form-group">
            <label for="perfil">Selecione o perfil e clique em continuar.</label>
            <select name="perfil" id="perfil" class="custom-select">
                <?php foreach ($perfis as $perfil): ?>
                <option value="<?= $perfil->getId(); ?>"><?= $perfil->getDescricao(); ?></option>
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