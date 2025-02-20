<?php ob_start(); ?>
<h1>Dépenses / Budget</h1>

<form method="get" class="sejour-selector">
    <input type="hidden" name="action" value="budget">
    <label for="sejour_id">Séjour :</label>
    <select name="sejour_id" id="sejour_id" onchange="this.form.submit()">
        <option value="0">-- Tous --</option>
        <?php foreach($sejours as $s): ?>
            <option value="<?= $s['id'] ?>" <?= ($s['id'] == $sejour_id) ? 'selected' : '' ?>>
                <?= htmlspecialchars($s['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<a class="btn" href="index.php?action=budget_form">Ajouter une dépense</a>

<table class="table-stock">
    <thead>
        <tr>
            <th>Date</th>
            <th>Catégorie</th>
            <th>Montant</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
    <?php $total = 0; ?>
    <?php foreach($expenses as $exp): ?>
        <?php $total += $exp['amount']; ?>
        <tr>
            <td><?= $exp['date'] ?></td>
            <td><?= htmlspecialchars($exp['category']) ?></td>
            <td><?= $exp['amount'] ?> €</td>
            <td><?= htmlspecialchars($exp['notes']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p>Total des dépenses : <strong><?= $total ?> €</strong></p>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
