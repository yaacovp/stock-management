<?php
$id = $sejour['id'] ?? 0;
ob_start();
?>
<h1><?= $id > 0 ? 'Modifier le séjour' : 'Créer un nouveau séjour' ?></h1>

<?php if(!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="index.php?action=sejour_save">
    <?php if($id > 0): ?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>

    <label>Nom :</label>
    <input type="text" name="name" value="<?= $sejour['name'] ?? '' ?>" required>

    <label>Date de début :</label>
    <input type="date" name="start_date" value="<?= $sejour['start_date'] ?? '' ?>" required>

    <label>Date de fin :</label>
    <input type="date" name="end_date" value="<?= $sejour['end_date'] ?? '' ?>" required>

    <button type="submit">Enregistrer</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
