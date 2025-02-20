
<?php ob_start(); ?>
<h1>Ajouter une dépense</h1>

<form method="post" action="index.php?action=budget_save">
    <label for="sejour_id">Séjour :</label>
    <select name="sejour_id" id="sejour_id">
        <option value="0">-- Aucun --</option>
        <?php foreach($sejours as $s): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="category">Catégorie :</label>
    <select name="category" id="category">
        <option value="Nourriture">Nourriture</option>
        <option value="Entretien">Entretien</option>
        <option value="Matériel">Matériel</option>
        <option value="Autre">Autre</option>
    </select>

    <label for="amount">Montant :</label>
    <input type="number" step="0.01" name="amount" id="amount" required>

    <label for="date">Date :</label>
    <input type="date" name="date" id="date" value="<?= date('Y-m-d') ?>">

    <label for="notes">Notes :</label>
    <textarea name="notes" id="notes"></textarea>

    <button type="submit">Enregistrer</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
