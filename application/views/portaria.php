<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="theme-color" content="#007bff">
        <title>AABB - Controle de acesso</title>
        <link rel="icon" type="image/png" href="<?= base_url('favicon.png'); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.theme.css'); ?>">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <span class="navbar-brand mb-0 h1">AABB - Controle de acesso</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Expadir navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="<?= base_url('logout'); ?>" class="nav-link ml-auto logout">Sair</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container mb-5 pt-3">
            <form action="<?= base_url('portaria'); ?>" method="post">
                <div class="row justify-content-center">
                    <div class="col-sm-6 form-group">
                        <p>Informe abaixo o código ou CPF do associado ou dependente.</p>
                        <div class="row">
                            <div class="col-sm-3 form-group">
                                <select class="custom-select" name="tipo-pesquisa" id="tipo-pesquisa">
                                    <option value="barcode" <?= ($tipoPesquisa == 'barcode') ? 'selected' : ''; ?>>Código</option>
                                    <option value="cpf" <?= ($tipoPesquisa == 'cpf') ? 'selected' : ''; ?>>CPF</option>
                                    <option value="nome" <?= ($tipoPesquisa == 'nome') ? 'selected' : ''; ?>>Nome</option>
                                </select>
                            </div>
                            <div class="col-sm-9 form-group">
                                <input type="text" name="search" id="search" required="" class="form-control" autofocus autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-6 form-group">
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                        <a href="<?= base_url('portaria'); ?>" class="btn btn-secondary">Limpar</a>
                    </div>
                </div>
            </form>
            <?php if (!empty($alertTxt)): ?>
                <div class="row justify-content-center">
                    <div class="col-sm-6 form-group">
                        <div class="alert <?= $alertClass; ?> alert-dismissible fade show" role="alert">
                            <?= $alertTxt; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($result)): ?>
                <div class="row justify-content-center">
                    <div class="col-sm-6 form-group">
                        <table class="table table-borderless table-hover">
                            <tr>
                                <td class="font-weight-bold" style="width: 50px">Modalidade:</td>
                                <td><?= get_class($result); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nome:</td>
                                <td><?= $result->getNome(); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">CPF:</td>
                                <td><?= $result->getCpf(); ?></td>
                            </tr>
                        </table>
                        <?php if (!$pagamentos): ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <i class="material-icons text-danger">local_atm</i>
                                Existem pendências. Peça que o associado procure a secretaria.
                            </div>
                        <?php else: ?>
                            <div class="alert alert-success text-center" role="alert">
                                <i class="material-icons text-success" data-toggle="tooltip" title="Não existem pendências">check</i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($result_nome)): ?>
                <div class="row justify-content-center">
                    <div class="col-sm-10 form-group">
                        <table class="table table-hover">
                            <thead>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Modalidade</th>
                            <th></th>
                            </thead>
                            <tbody>
                                <?php if (!empty($result_nome[0]) || !empty($result_nome[1])): ?>
                                    <?php foreach ($result_nome as $records): ?>
                                        <?php foreach ($records as $record): ?>
                                            <tr>
                                                <td><?= $record->getNome(); ?></td>
                                                <td><?= $record->getCpf(); ?></td>
                                                <td><?= get_class($record); ?></td>
                                                <td>
                                                    <a href="<?= base_url('portaria/visualizar/?class=' . strtolower(get_class($record)) . '&id=' . $record->getId()); ?>" 
                                                       class="btn btn-sm btn-primary">Selecionar</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Não foram encontrados resultados.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <script src="<?= base_url('assets/js/jquery.js'); ?>"></script>
        <script src="<?= base_url('assets/js/jquery-ui.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="<?= base_url('assets/js/mask.js'); ?>"></script>
        <script>
            $('.logout').click(function () {
                return confirm('Deseja realmente sair do sistema?');
            });
            var search = $('#search');
            var tipo = $('#tipo-pesquisa');
            tipo.change(function () {
                var val = tipo.val();
                switch (val) {
                    case 'barcode':
                        search.mask('S000000');
                        break;
                    case 'cpf':
                        search.mask('000.000.000-00');
                        break;
                    case 'nome':
                        search.unmask();
                        break;
                }
            });
            switch (tipo.val()) {
                case 'barcode':
                    search.mask('S000000');
                    break;
                case 'cpf':
                    search.mask('000.000.000-00');
                    break;
                case 'nome':
                    search.unmask();
                    break;
            }
            $('[data-toggle="tooltip"]').tooltip();
        </script>
    </body>
</html>