<table class="table table-sm">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($documentos as $documento): ?>
        <tr>
            <td>
                <?=$documento->getTipoDocumento()->getDescricao();?>
            </td>
            <td>
                <a href="<?=base_url($documento->getPath());?>" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="material-icons">search</i>
                </a>
                <?php if ($edit == false): ?>
                <a href="<?=base_url('documentos/excluir/' . $documento->getId() . '/?from=dependentes&fromId=' . $dependente->getId() . '&path=' . $documento->getPath());?>" class="btn btn-sm btn-outline-danger confirm">
                    <i class="material-icons">delete</i>
                </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php if ($edit == false): ?>
<a href="<?= base_url('documentos/novo/?from=dependentes&id=' . $dependente->getId()); ?>" class="btn btn-sm btn-outline-primary">Novo documento</a>
<?php endif; ?>