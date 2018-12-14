<h3 class="text-primary">Novo plano</h3>
<hr>
<form action="<?= base_url('planos/salvar'); ?>" method="post">
    <div class="row">
        <div class="col-sm-5 form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descricao" required>
        </div>
        <div class="col-sm-3 form-group">
            <label for="valor">Valor</label>
            <input type="text" class="form-control money" name="valor" id="valor" required>
        </div>
    </div>
    <div class="row">
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('planos'); ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</form>