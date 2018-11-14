<h3 class="text-primary mt-3">Contatos de <?= $associado->getNome(); ?></h3>
<hr>
<form action="<?= base_url('contatos/salvar'); ?>" method="post">
  <input type="hidden" name="id" value="<?= $associado->getId(); ?>">
  <h5 class="text-primary">Telefones</h5>
  <div class="form-telefone">
    <div class="form-group form-row">
      <div class="col-md-2">
        <input type="text" name="ddd[]" maxlength="2" class="form-control ddd" placeholder="DDD" required="">
      </div>
      <div class="col-md-4">
        <input type="text" name="telefone[]" class="form-control phone" placeholder="Telefone" required="">
      </div>
    </div>
  </div>
  <div class="form-row form-group">
    <div class="col">
      <button type="button" name="novo-telefone" id="novo-telefone" class="btn btn-sm btn-outline-primary">Adicionar campos</button>
    </div>
  </div>
  <h5 class="text-primary">Endereços</h5>
  <div class="form-group form-row">
    <div class="col-6">
      <label>Logradouro</label>
      <input type="text" name="logradouro" class="form-control" required="">
    </div>
    <div class="col-2">
      <label>Número</label>
      <input type="number" name="numero" class="form-control" min="0" required="">
    </div>
    <div class="col">
      <label>Bairro</label>
      <input type="text" name="bairro" class="form-control" required="">
    </div>
  </div>
  <div class="form-group form-row">
    <div class="col">
      <label>Complemento</label>
      <input type="text" name="complemento" class="form-control">
    </div>
    <div class="col">
      <label>Cidade</label>
      <input type="text" name="cidade" value="Conceição das Alagoas" class="form-control" required="">
    </div>
    <div class="col">
      <label>Estado</label>
      <select name="estado" class="form-control">
        <option value="AC">Acre</option>
        <option value="AL">Alagoas</option>
        <option value="AP">Amapá</option>
        <option value="AM">Amazonas</option>
        <option value="BA">Bahia</option>
        <option value="CE">Ceará</option>
        <option value="DF">Distrito Federal</option>
        <option value="ES">Espírito Santo</option>
        <option value="GO">Goiás</option>
        <option value="MA">Maranhão</option>
        <option value="MT">Mato Grosso</option>
        <option value="MS">Mato Grosso do Sul</option>
        <option value="MG" selected="">Minas Gerais</option>
        <option value="PA">Pará</option>
        <option value="PB">Paraíba</option>
        <option value="PR">Paraná</option>
        <option value="PE">Pernambuco</option>
        <option value="PI">Piauí</option>
        <option value="RJ">Rio de Janeiro</option>
        <option value="RN">Rio Grande do Norte</option>
        <option value="RS">Rio Grande do Sul</option>
        <option value="RO">Rondônia</option>
        <option value="RR">Roraima</option>
        <option value="SC">Santa Catarina</option>
        <option value="SP">São Paulo</option>
        <option value="SE">Sergipe</option>
        <option value="TO">Tocantins</option>
      </select>
    </div>
    <div class="col">
      <label>CEP</label>
      <input type="text" name="cep" value="38.120-000" class="form-control cep" required="">
    </div>
  </div>
  <hr>
  <div class="form-row">
    <div class="col">
      <button type="submit" class="btn btn-primary">Salvar e continuar</button>
    </div>
  </div>
</form>
