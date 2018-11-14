<form id="form-dependente" method="post">
  <input type="hidden" name="id" value="<?= $dependente->getId(); ?>">
  <div class="form-dependente">
    <div class="form-row form-group">
      <div class="col">
        <label>Nome completo</label>
        <input type="text" name="nome" class="form-control" required="" value="<?= $dependente->getNome(); ?>">
      </div>
      <div class="col-4">
        <label>Data de nascimento</label>
        <input type="text" name="nascimento" class="form-control date" required="" value="<?= $dependente->getNascimento(true); ?>">
      </div>
    </div>
    <div class="form-row form-group">
      <div class="col">
        <label>CPF</label>
        <input type="text" name="cpf" class="form-control cpf" required="" value="<?= $dependente->getCpf(); ?>">
      </div>
      <div class="col">
        <label>Grau de parentesco</label>
        <select class="form-control" name="parentesco" required="">
          <option value="Filho" <?= ($dependente->getParentesco() == 'Filho') ? 'selected' : ''; ?>>Filho(a)</option>
          <option value="Conjuge" <?= ($dependente->getParentesco() == 'Conjuge') ? 'selected' : ''; ?>>Cônjuge</option>
          <option value="Pais" <?= ($dependente->getParentesco() == 'Pais') ? 'selected' : ''; ?>>Pai ou mãe</option>
          <option value="Outros" <?= ($dependente->getParentesco() == 'Outros') ? 'selected' : ''; ?>>Outros</option>
        </select>
      </div>
    </div>
  </div>
  <hr>
  <div class="form-row form-group">
    <div class="col text-right">
      <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
  </div>
</form>
