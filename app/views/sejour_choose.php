<?php ob_start(); ?>
<h1>Choisir un séjour</h1>

<?php if (empty($sejours)): ?>
    <p>Aucun séjour disponible. Veuillez en créer un.</p>
<?php else: ?>
    <p>Sélectionnez le séjour :</p>
    <div class="sejour-buttons">
        <?php foreach ($sejours as $s): ?>
            <a class="btn sejour-button" href="index.php?action=init_sejour&sejour_id=<?= $s['id'] ?>">
                <!-- Retirer l'image -->
                <div>
                    <?= htmlspecialchars($s['name']) ?><br>
                    <small>(du <?= $s['start_date'] ?> au <?= $s['end_date'] ?>)</small>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<p>
    <a class="btn" href="index.php?action=sejour">Gestion des Séjours</a>
</p>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
