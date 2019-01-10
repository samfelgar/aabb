<h3 class="text-primary">Alterar taxa</h3>
<hr>
<form action="<?= base_url('taxas/salvar'); ?>" method="post">
    <input type="hidden" name="id" id="id" value="<?= $taxa->getId(); ?>">
    <div class="row">
        <div class="form-group col-sm">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" required="" value="<?= $taxa->getDescricao(); ?>">
        </div>
        <div class="form-group col-sm-4">
            <label for="valor">Valor</label>
            <input type="text" name="valor" id="valor" class="form-control money" required="" value="<?= $taxa->getValor(true); ?>">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-3">
            <label for="gratuidade">Gratuidade</label>
            <input type="number" name="gratuidade" id="gratuidade" class="form-control" min="0" value="<?= $taxa->getGratuidade(); ?>" required="">
        </div>
        <div class="form-group col-sm-3">
            <label for="parcelas">Número de parcelas</label>
            <input type="number" name="parcelas" id="parcelas" class="form-control" min="1" value="<?= $taxa->getParcelas(); ?>" required="">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm">
            <button class="btn btn-primary">Salvar</button>
            <a href="<?= base_url('taxas'); ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</form>