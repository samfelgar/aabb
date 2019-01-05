<h3 class="text-primary">Termo de adesão</h3>
<hr>
<?php if ($updated): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Termo atualizado com sucesso!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<form action="<?= base_url('termo/salvar'); ?>" method="post">
    <div class="row">
        <div class="col-sm form-group">
            <textarea name="terms" id="terms" class="form-control" rows="15"><?= $terms; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</form>