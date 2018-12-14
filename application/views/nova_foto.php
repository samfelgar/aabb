<div class="modal fade" id="loading-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Carregando...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col loading text-center">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary disabled loading-link">Continuar</a>
      </div>
    </div>
  </div>
</div>
<h3 class="text-primary">Foto de <?= $usuario->getNome(); ?></h3>
<hr>
<form action="<?= base_url('fotos/salvar'); ?>" method="post" enctype="multipart/form-data">
  <input type="hidden" name="usuario" value="<?= $usuario->getId(); ?>">
  <input type="hidden" name="tipo" value="<?= $tipo; ?>">
  <input type="hidden" name="acao" value="<?= $acao; ?>">
  <div class="row">
    <div class="col text-center">
      <video class="camera" width="400" height="300" autoplay></video>
      <div class="photo" style="display:none">
        <canvas width="400" height="300"></canvas>
      </div>
    </div>
  </div>
  <div class="row form-group">
    <div class="col text-center command-btn">
      <button type="button" class="btn btn-outline-secondary go-back">Voltar</button>
      <button type="button" class="pause btn btn-outline-primary">Capturar</button>
      <button type="button" class="capture-new btn btn-outline-danger" style="display:none">Capturar outra</button>
      <button type="button" class="capture btn btn-outline-primary" style="display:none">Salvar</button>
    </div>
  </div>
  <?php if ($acao == 'nova'): ?>
    <div class="row form-group">
      <div class="col text-center">
        <a href="<?= base_url('contatos/novo/' . $usuario->getId()); ?>" class="btn btn-outline-success" name="button">Pular esta etapa <span data-feather="chevrons-right"></span></a>
      </div>
    </div>
  <?php endif;?>
</form>
