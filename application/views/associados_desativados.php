<h3 class="text-primary">Associados desativados</h3>
<hr>
<div class="d-flex align-items-center mb-3">
    <a href="<?= base_url('associados/pesquisar_associado'); ?>" class="btn btn-outline-primary btn-sm">Adicionar associado</a>
</div>
<table class="table table-sm table-hover table-responsive-sm dt">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Agência</th>
            <th>Conta</th>
            <th>Forma de pagamento</th>
            <th>Plano</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($associados as $associado): ?>
        <tr>
            <td>
                <?= $associado->getNome(); ?>
            </td>
            <td>
                <?= $associado->getCpf(); ?>
            </td>
            <td>
                <?= $associado->getAgencia(); ?>
            </td>
            <td>
                <?= $associado->getConta(); ?>
            </td>
            <td class="text-capitalize">
                <?= $associado->getFormaPagamento(); ?>
            </td>
            <td>
                <?= $associado->getPlano()->getDescricao(); ?>
            </td>
            <td>
                <a href="<?= base_url('associados/editar/') . $associado->getId(); ?>" title="Ver mais">Detalhes</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>