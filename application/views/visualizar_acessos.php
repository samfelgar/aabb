<h3 class="text-primary">Acessos do perfil
    <?= $perfil->getDescricao(); ?>
</h3>
<p class="text-muted">Para incluir ou remover um acesso, marque uma opção abaixo.</p>
<div class="row">
    <div class="col-sm">
        <form action="<?= base_url('acessos/adicionar'); ?>" method="post">
            <div class="row">
                <div class="col-sm">
                    <h5 class="text-primary">Adicionar</h5>
                    <input type="hidden" name="perfil" value="<?= $perfil->getId(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm form-group">
                    <?php if (count($menusInativos) == 0): ?>
                        <p>O perfil possui todos os acessos.</p>
                    <?php else: ?>
                        <?php foreach ($menusInativos as $keyMenu => $menuInativo): ?>
                            <?php foreach ($menuInativo as $indexMenu => $menuValue): ?>
                                <?php
                                $marginLeftInativos = false;
                                if ($menuInativo[0]->getId() == $keyMenu) {
                                    $marginLeftInativos = true;
                                }
                                ?>
                                <div class="form-check <?= (!empty($menuValue->getMenu()) && $marginLeftInativos) ? 'ml-4' : ''; ?>">
                                    <input type="checkbox" class="form-check-input" id="<?= $menuValue->getId(); ?>" name="menus[]" value="<?= $menuValue->getId(); ?>">
                                    <label for="<?= $menuValue->getId(); ?>" class="form-check-label"><?= $menuValue->getDescricao(); ?></label>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm form-group">
                    <button type="submit" class="btn btn-primary" <?= (count($menusInativos) == 0) ? 'disabled' : ''; ?>>Adicionar</button>
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm">
        <form action="<?= base_url('acessos/remover'); ?>" method="post">
            <div class="row">
                <div class="col-sm">
                    <h5 class="text-danger">Remover</h5>
                    <input type="hidden" name="perfil" value="<?= $perfil->getId(); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm form-group">
                    <?php if (count($menusAtivos) == 0): ?>
                        <p>O perfil não possui nenhum acesso.</p>
                    <?php else: ?>
                        <?php foreach ($menusAtivos as $keyMenu => $menuAtivo): ?>
                            <?php foreach ($menuAtivo as $indexMenu => $menuValue): ?>
                                <?php
                                $marginLeftAtivos = false;
                                if ($menuAtivo[0]->getId() == $keyMenu) {
                                    $marginLeftAtivos = true;
                                }
                                ?>
                                <div class="form-check <?= (!empty($menuValue->getMenu()) && $marginLeftAtivos) ? 'ml-4' : ''; ?>">
                                    <input type="checkbox" class="form-check-input" id="<?= $menuValue->getId(); ?>" name="menus[]" value="<?= $menuValue->getId(); ?>">
                                    <label for="<?= $menuValue->getId(); ?>" class="form-check-label"><?= $menuValue->getDescricao(); ?></label>
                                </div>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm form-group">
                    <button type="submit" class="btn btn-danger" <?= (count($menusAtivos) == 0) ? 'disabled' : ''; ?>>Remover</button>
                    <button type="reset" class="btn btn-secondary">Limpar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <a href="<?= base_url('acessos'); ?>" class="btn btn-secondary">Voltar</a>
    </div>
</div>
