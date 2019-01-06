<form id="form-telefone" method="post">
    <input type="hidden" name="id" value="<?= $telefone->getId(); ?>">
    <div class="row form-group">
        <div class="col-3">
            <label for="ddd">DDD</label>
            <input type="text" id="ddd" name="ddd" class="form-control ddd" maxlength="2" required="required" value="<?= $telefone->getDdd(); ?>">
        </div>
        <div class="col">
            <label for="telefone">Número</label>
            <input type="text" id="telefone" name="telefone" class="form-control phone" required="required" value="<?= $telefone->getTelefone(); ?>">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col text-right">
            <button type="submit" class="btn btn-primary" name="button">Salvar</button>
        </div>
    </div>
</form>
