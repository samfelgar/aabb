<h3 class="text-primary">Novo associado</h3>
<hr>
<form method="post" action="<?=base_url('associados/salvar/');?>">
    <div class="form-row form-group">
        <div class="col">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required="">
        </div>
        <div class="col">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" class="form-control cpf" readonly="" required="" value="<?= $cpf; ?>">
        </div>
        <div class="col">
            <label for="rg">RG</label>
            <input type="text" name="rg" id="rg" class="form-control" required="">
        </div>
        <div class="col">
            <label for="estado-civil">Estado civil</label>
            <select name="estado-civil" id="estado-civil" class="form-control" required="">
                <option value="solteiro">Solteiro(a)</option>
                <option value="casado">Casado(a)</option>
                <option value="divorciado">Divorciado(a)</option>
                <option value="viuvo">Viúvo(a)</option>
                <option value="separado">Separado(a)</option>
            </select>
        </div>
    </div>
    <div class="form-row form-group">
        <div class="col">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="col">
            <label for="nascimento">Data de nascimento</label>
            <input type="text" name="nascimento" id="nascimento" class="form-control date" required="" autocomplete="off">
        </div>
        <div class="col">
            <label for="data-associacao">Membro desde</label>
            <input type="text" name="data-associacao" id="data-associacao" class="form-control date" required="" autocomplete="off">
        </div>
        <div class="col">
            <label for="plano">Plano</label>
            <select name="plano" id="plano" class="form-control" required="">
                <?php foreach ($planos as $plano): ?>
                <option value="<?=$plano->getId();?>">
                    <?=$plano->getDescricao();?>
                </option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="form-row form-group">
        <div class="col">
            <label for="agencia">Agência</label>
            <input type="text" name="agencia" id="agencia" class="form-control agencia">
        </div>
        <div class="col">
            <label for="conta">Conta</label>
            <input type="text" name="conta" id="conta" class="form-control conta">
        </div>
        <div class="col">
            <label for="tipo-conta">Tipo de conta</label>
            <select name="tipo-conta" id="tipo-conta" class="form-control">
                <option value="">Selecione</option>
                <option value="corrente">Corrente</option>
                <option value="poupanca">Poupança</option>
            </select>
        </div>
        <div class="col">
            <label for="forma-pagamento">Forma de pagamento</label>
            <select name="forma-pagamento" id="forma-pagamento" class="form-control" required="">
                <option value="conta">Débito em conta</option>
                <option value="boleto">Boleto</option>
                <option value="cartao">Cartão de crédito</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row form-group">
        <div class="col">
            <button type="submit" class="btn btn-primary">Salvar e continuar</button>
            <input type="button" value="Voltar" class="btn btn-outline-secondary go-back">
        </div>
    </div>
</form>