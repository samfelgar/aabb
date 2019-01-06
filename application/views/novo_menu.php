<h3 class="text-primary">Adicionar menu</h3>
<form action="<?= base_url('menus/salvar'); ?>" method="post">
    <div class="row">
        <div class="col-sm form-group">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" required="">
        </div>
        <div class="col-sm form-group">
            <label for="url">URL</label>
            <input type="text" name="url" id="url" class="form-control" required="">
        </div>
    </div>
    <div class="row">
        <div class="col-sm form-group">
            <label for="menu-pai">Menu acima</label>
            <select name="menu-pai" id="menu-pai" class="custom-select">
                <option value="">Nenhum</option>
                <?php foreach ($menusPai as $mp): ?>
                    <option value="<?= $mp->getId(); ?>"><?= $mp->getDescricao(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('menus'); ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</form>