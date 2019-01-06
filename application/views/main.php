<div class="jumbotron">
    <h1 class="display-4 text-primary">Associados</h1>
    <p class="lead">Atualmente são <?= $totalAssociados; ?> associados em nossa base. Consulte <a href="#planos">abaixo</a> a receita esperada.</p>
</div>
<div class="card" style="width: 18rem;">
    <h5 class="card-header" id="planos">Planos contratados</h5>
    <div class="card-body">
        <?php $total = 0; ?>
        <?php foreach ($associadosPorPlano as $ap): ?>
            <?php
            $valorParcial = $ap[0]->getValor() * $ap[1];
            $total += $valorParcial;
            ?>
            <p><strong><?= $ap[0]->getDescricao(); ?>:</strong> <?= $ap[1]; ?>, total R$ <?= number_format($valorParcial, 2, ',', '.'); ?></p>
        <?php endforeach; ?>
        <p><strong>Receita total: </strong> R$ <?= number_format($total, 2, ',', '.'); ?></p>
    </div>
</div>
