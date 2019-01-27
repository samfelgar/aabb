<div class="modal fade" id="add-modal" role="dialog">
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
                    <div class="col-sm add-body">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display:none">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Fechar</button>
            </div>
        </div>
    </div>
</div>
<h3 class="text-primary">Usuários do sistema</h3>
<a href="<?= base_url('usuarios/novo'); ?>" class="btn btn-outline-primary btn-sm mb-3">Adicionar novo</a>
<table class="table table-sm table-hover table-responsive-sm dt">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Perfil</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario->getUser(); ?></td>
                <td><?= $usuario->getPerfil()->getDescricao(); ?></td>
                <td>
                    <a href="<?= base_url('usuarios/alterar/' . $usuario->getId()); ?>" class="btn btn-sm btn-outline-primary" title="Alterar perfil">
                        <i class="material-icons">supervisor_account</i> Alterar perfil
                    </a>
                    <a href="<?= base_url('usuarios/redefinir/' . $usuario->getId()); ?>" class="btn btn-sm btn-outline-primary" title="Redefinir senha">
                        <i class="material-icons">lock</i> Redefinir senha
                    </a>
                    <a href="<?= base_url('usuarios/excluir/' . $usuario->getId()); ?>" class="btn btn-sm btn-outline-danger delete-user">
                        <i class="material-icons">delete</i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>