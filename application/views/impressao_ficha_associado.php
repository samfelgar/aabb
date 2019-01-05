<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#007bff">
    <title>AABB</title>
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png'); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="<?=base_url('assets/css/main.css');?>">
</head>

<body>
    <div class="container pt-3">
        <h2 class="text-center mb-4">Associação Atlética Banco do Brasil - AABB</h2>
        <h3><?= $associado->getNome(); ?></h3>
        <hr>
        <form>
            <div class="form-row">
                <div class="col-sm">
                    <div class="form-row">
                        <div class="col-sm form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control cpf" value="<?= $associado->getCpf(); ?>"
                                disabled="">
                        </div>
                        <div class="col-sm form-group">
                            <label for="rg">RG</label>
                            <input type="text" name="rg" id="rg" class="form-control" value="<?= $associado->getRg(); ?>"
                                disabled="">
                        </div>
                        <div class="col-sm form-group">
                            <label for="estado-civil">Estado civil</label>
                            <input type="text" class="form-control text-capitalize" value="<?= $associado->getEstadoCivil(); ?>" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= $associado->getEmail(); ?>"
                                disabled="">
                        </div>
                        <div class="col-sm form-group">
                            <label for="nascimento">Data de nascimento</label>
                            <input type="text" name="nascimento" id="nascimento" class="form-control" value="<?= $associado->getNascimento(true); ?>"
                                disabled="">
                        </div>
                        <div class="col-sm form-group">
                            <label for="data-associacao">Membro desde</label>
                            <input type="text" name="data-associacao" id="data-associacao" class="form-control" value="<?= $associado->getDataAssociacao(true); ?>"
                                disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm form-group">
                    <label for="plano">Plano</label>
                    <input type="text" class="form-control" value="<?= $associado->getPlano()->getDescricao(); ?>" disabled>
                </div>
                <div class="col-sm form-group">
                    <label for="agencia">Agência</label>
                    <input type="text" name="agencia" id="agencia" class="form-control" value="<?= $associado->getAgencia(); ?>"
                        disabled="">
                </div>
                <div class="col-sm form-group">
                    <label for="conta">Conta</label>
                    <input type="text" name="conta" id="conta" class="form-control" value="<?= $associado->getConta(); ?>"
                        disabled="">
                </div>
                <div class="col-sm form-group">
                    <label for="tipo-conta">Tipo de conta</label>
                    <select name="tipo-conta" id="tipo-conta" class="form-control" disabled="">
                        <option value="corrente" <?=($associado->getTipoConta() == 'corrente') ? 'selected' : '';
                            ?>>Corrente</option>
                        <option value="poupanca" <?=($associado->getTipoConta() == 'poupanca') ? 'selected' : '';
                            ?>>Poupança</option>
                    </select>
                </div>
                <div class="col-sm form-group">
                    <label for="forma-pagamento">Forma de pagamento</label>
                    <select name="forma-pagamento" id="forma-pagamento" class="form-control" disabled="">
                        <option value="conta" <?=($associado->getFormaPagamento() == 'conta') ? 'selected' : '';
                            ?>>Débito
                            em conta</option>
                        <option value="boleto" <?=($associado->getFormaPagamento() == 'boleto') ? 'selected' : '';
                            ?>>Boleto</option>
                        <option value="cartao" <?=($associado->getFormaPagamento() == 'cartao') ? 'selected' : '';
                            ?>>Cartão de crédito</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-4 form-group">
                    <label>Telefones</label>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>DDD</th>
                                <th>Número</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($telefones as $telefone): ?>
                            <tr>
                                <td>
                                    <?= $telefone->getDdd(); ?>
                                </td>
                                <td>
                                    <?= $telefone->getTelefone(); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm form-group">
                    <label>Endereços</label>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Logradouro</th>
                                <th>Número</th>
                                <th>Complemento</th>
                                <th>Bairro</th>
                                <th>Cidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($enderecos as $endereco): ?>
                            <tr>
                                <td>
                                    <?= $endereco->getLogradouro(); ?>
                                </td>
                                <td>
                                    <?= $endereco->getNumero(); ?>
                                </td>
                                <td>
                                    <?= $endereco->getComplemento(); ?>
                                </td>
                                <td>
                                    <?= $endereco->getBairro(); ?>
                                </td>
                                <td>
                                    <?= $endereco->getCidade(); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm form-group">
                    <label>Dependentes</label>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Nascimento</th>
                                <th>CPF</th>
                                <th>Parentesco</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($dependentes) > 0): ?>
                                <?php foreach ($dependentes as $dependente): ?>
                                <tr>
                                    <td>
                                        <?= $dependente->getNome(); ?>
                                    </td>
                                    <td>
                                        <?= $dependente->getNascimento(true); ?>
                                    </td>
                                    <td>
                                        <?= $dependente->getCpf(); ?>
                                    </td>
                                    <td>
                                        <?= $dependente->getParentesco(); ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Não há dependentes cadastrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <h4>Termo de adesão</h4>
        <div class="row">
            <div class="col-sm text-justify form-group">
                <?= nl2br($termo); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm form-group text-right">
                <p><?= $cidade; ?>, <?= (new DateTime())->format('d/m/Y'); ?>.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm form-group">
                <div class="signature"></div>
                <p class="text-uppercase"><?= $associado->getNome(); ?><br>
                <?= $associado->getCpf(); ?></p>
            </div>
        </div>
    </div>
    <script>
        var base_url = '<?= base_url(); ?>';
        window.onload = function() { window.print(); }
    </script>
    <script src="<?= base_url('assets/js/jquery.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/mask.js'); ?>"></script>
    <script src="<?= base_url('assets/js/main.js'); ?>"></script>
</body>

</html>