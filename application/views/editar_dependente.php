<h3 class="text-primary">Alteração de dependente</h3>
<hr>
<form action="<?= base_url('dependentes/salvar/' . $dependente->getId()); ?>" method="post">
    <div class="form-row">
        <div class="col-sm form-group">
            <label>Nome completo</label>
            <input type="text" name="nome" class="form-control" required="" value="<?= $dependente->getNome(); ?>">
        </div>
        <div class="col-sm-4 form-group">
            <label>Data de nascimento</label>
            <input type="text" name="nascimento" class="form-control date" required="" value="<?= $dependente->getNascimento(true); ?>" autocomplete="off">
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm form-group">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control cpf" required="" value="<?= $dependente->getCpf(); ?>">
        </div>
        <div class="col-sm form-group">
            <label>Grau de parentesco</label>
            <select class="form-control" name="parentesco" required="">
                <option value="Filho" <?=($dependente->getParentesco() == 'Filho') ? 'selected' : ''; ?>>Filho(a)</option>
                <option value="Conjuge" <?=($dependente->getParentesco() == 'Conjuge') ? 'selected' : ''; ?>>Cônjuge</option>
                <option value="Pais" <?=($dependente->getParentesco() == 'Pais') ? 'selected' : ''; ?>>Pai ou mãe</option>
                <option value="Outros" <?=($dependente->getParentesco() == 'Outros') ? 'selected' : ''; ?>>Outros</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="form-row">
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-secondary go-back">Voltar</button>
        </div>
    </div>
</form>