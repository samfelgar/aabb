<form id="form-dependente" method="post">
  <div class="form-dependente">
    <div class="form-row form-group">
      <div class="col">
        <label>Nome completo</label>
        <input type="text" name="nome" class="form-control" required="">
      </div>
      <div class="col-4">
        <label>Data de nascimento</label>
        <input type="text" name="nascimento" class="form-control date" required="">
      </div>
    </div>
    <div class="form-row form-group">
      <div class="col">
        <label>CPF</label>
        <input type="text" name="cpf" class="form-control cpf" required="">
      </div>
      <div class="col">
        <label>Grau de parentesco</label>
        <select class="form-control" name="parentesco" required="">
          <option value="Filho">Filho(a)</option>
          <option value="Conjuge">Cônjuge</option>
          <option value="Pais">Pai ou mãe</option>
          <option value="Outros">Outros</option>
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
