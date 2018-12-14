<h3 class="text-primary">Novo dependente de <?=$associado->getNome();?></h3>
<hr>
<form action="<?=base_url('dependentes/salvar');?>" method="post">
    <input type="hidden" id="associado-id" name="associado-id" value="<?=$associado->getId();?>">
    <div class="form-row">
        <div class="form-group col-sm">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required="">
        </div>
        <div class="form-group col-sm-4">
            <label>Data de nascimento</label>
            <input type="text" name="nascimento" class="form-control date" required="">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-4">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control cpf" required="">
        </div>
        <div class="form-group col-sm-4">
            <label>Grau de parentesco</label>
            <select class="form-control" name="parentesco" required="">
                <option value="Filho">Filho(a)</option>
                <option value="Conjuge">Cônjuge</option>
                <option value="Pais">Pai ou mãe</option>
                <option value="Outros">Outros</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="form-row">
        <div class="col form-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-secondary go-back">Voltar</button>
        </div>
    </div>
</form>