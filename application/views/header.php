<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AABB</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.theme.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/datatables.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>">
</head>
<body>
  <script type="text/javascript">
    var cameraNeeded = false;
  </script>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a href="<?= base_url(); ?>" class="navbar-brand mb-0 h1">AABB</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Expadir navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= ($active == 'home') ? 'active' : ''; ?>" href="<?= base_url(); ?>">Início</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= ($active == 'associados') ? 'active' : ''; ?>" href="#" data-toggle="dropdown">Associados</a>
          <div class="dropdown-menu">
            <a href="<?= base_url('associados/novo'); ?>" class="dropdown-item" accesskey="n">Novo <span class="text-muted"><small>Alt+N</small></span></a>
            <a href="<?= base_url('associados'); ?>" class="dropdown-item">Todos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= ($active == 'financeiro') ? 'active' : ''; ?>" href="#" data-toggle="dropdown">Financeiro</a>
          <div class="dropdown-menu">
            <a href="<?= base_url('financeiro'); ?>" class="dropdown-item">Lançamentos</a>
            <a href="<?= base_url('financeiro/inadimplentes'); ?>" class="dropdown-item">Inadimplentes</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($active == 'planos') ? 'active' : ''; ?>" href="<?= base_url('planos'); ?>">Planos</a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('logout'); ?>" class="nav-link">Sair</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container mb-5">
