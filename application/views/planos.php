<h3 class="text-primary mt-3">Administração de planos de associados</h3>
<button class="btn btn-outline-primary btn-sm mb-3">Adicionar plano</button>
<table class="table dt">
    <thead>
        <tr>
            <th>id</th>
            <th>Descrição</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($planos as $plano): ?>
            <tr>
                <td><?= $plano->getId(); ?></td>
                <td><?= $plano->getDescricao(); ?></td>
                <td>R$ <?= $plano->getValor(); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
