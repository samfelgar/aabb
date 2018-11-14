<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AABB</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
</head>
<body>
  <div class="container">
    <form action="<?= base_url('login/acessar'); ?>" method="post">
      <h2>Bem vindo!</h2>
      <div class="row form-group">
        <div class="col">
          <input type="text" id="login" name="login" class="form-control" autofocus placeholder="Usuário" required>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <input type="password" id="pass" name="pass" class="form-control" placeholder="Senha" required>
        </div>
      </div>
      <div class="row form-group">
        <div class="col">
          <button type="submit" name="button" class="btn btn-primary">Entrar</button>
        </div>
      </div>
      <div class="alert alert-danger <?= $alert_display; ?>"><?= $msg; ?></div>
      <p class="text-muted">Preencha os campos acima para acessar o sistema.</p>
    </form>
  </div>
  <script src="<?= base_url('assets/js/jquery.js'); ?>"></script>
  <script src="<?= base_url('assets/js/jquery-ui.js'); ?>"></script>
  <script src="<?= base_url('assets/js/popper.js'); ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
</body>
</html>
