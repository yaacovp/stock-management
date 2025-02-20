<?php ob_start(); ?>
<h1>Tableau de bord</h1>

<form method="get" class="sejour-selector">
    <!-- On renvoie vers l'action=dashboard -->
    <input type="hidden" name="action" value="dashboard">

    <label for="sejour_id">Séjour actif :</label>
    <select name="sejour_id" id="sejour_id" onchange="this.form.submit()">
        <option value="0" <?= ($sejour_id == 0) ? 'selected' : '' ?>>
            -- Tous les séjours --
        </option>

        <?php foreach($sejours as $s): ?>
            <option value="<?= $s['id'] ?>" <?= ($s['id'] == $sejour_id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($s['name']) ?>
                (du <?= $s['start_date'] ?> au <?= $s['end_date'] ?>)
            </option>
        <?php endforeach; ?>
    </select>
</form>

<p>Total de produits : <strong><?= $totalProducts ?></strong></p>
<p>Produits en alerte (stock < seuil) : <strong><?= $alertCount ?></strong></p>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
