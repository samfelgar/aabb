<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="theme-color" content="#007bff">
        <title>Blue Software - Prisma Tecnologia</title>
        <link rel="icon" type="image/png" href="<?= base_url('favicon.png'); ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.theme.css'); ?>">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
        <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a href="<?= base_url(); ?>" class="navbar-brand mb-0 h1">
                <img src="<?= base_url('assets/images/blue_logo_7.png'); ?>" alt="" width="30" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Expadir navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($active == 'home') ? 'active' : ''; ?>" href="<?= base_url(); ?>">Início</a>
                    </li>
                    <?php foreach ($menus as $menu): ?>
                        <?php if (count($menu) == 1): ?>
                            <li class="nav-item">
                                <a class="nav-link <?= ($active == strtolower($menu[0]->getDescricao())) ? 'active' : ''; ?>" href="<?= base_url($menu[0]->getUrl()); ?>"><?= $menu[0]->getDescricao(); ?></a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle <?= ($active == strtolower($menu[0]->getDescricao())) ? 'active' : ''; ?>" href="#" data-toggle="dropdown"><?= $menu[0]->getDescricao(); ?></a>
                                <div class="dropdown-menu">
                                    <?php foreach ($menu as $k => $v): ?>
                                        <?php if ($k == 0) continue; ?>
                                        <a href="<?= base_url($v->getUrl()); ?>" class="dropdown-item"><?= $v->getDescricao(); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <span class="ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Olá, <span class="text-capitalize"><?= $_SESSION['user']; ?></span></a>
                            <div class="dropdown-menu">
                                <a href="<?= base_url('usuarios/alterar_senha/' . $_SESSION['user_id']); ?>" class="dropdown-item">Alterar senha</a>
                                <a href="<?= base_url('logout'); ?>" class="dropdown-item logout">Sair</a>
                            </div>
                        </li>
                    </ul>
                </span>
                <span class="">
                    <a href="https://correio.fenabb.org.br/" target="_blank" class="btn btn-sm btn-primary" title="E-mail FENABB">
                        <span class="d-lg-none">Acesso ao e-mail</span>
                        <i class="material-icons md-18 d-lg-none">open_in_new</i>
                        <i class="material-icons d-none d-lg-inline">mail</i>
                    </a>
                </span>
            </div>
        </nav>
        <div class="container mb-5 pt-3">
