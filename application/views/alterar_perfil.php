<h3 class="text-primary">Alterar perfil</h3>
<form action="<?= base_url('perfis/salvar/' . $perfil->getId()); ?>" method="post">
    <div class="row">
        <div class="col-sm-5 form-group">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="<?= $perfil->getDescricao(); ?>" required="">
        </div>
    </div>
    <div class="row">
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('perfis'); ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</form>