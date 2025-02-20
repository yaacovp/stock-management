
<?php
$editing = isset($supplier);
ob_start();
?>
<h1><?= $editing ? 'Modifier' : 'Ajouter' ?> un fournisseur</h1>

<form method="post" action="index.php?action=supplier_save">
    <?php if($editing): ?>
        <input type="hidden" name="id" value="<?= $supplier['id'] ?>">
    <?php endif; ?>

    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" value="<?= $supplier['name'] ?? '' ?>" required>

    <label for="contact_name">Contact :</label>
    <input type="text" name="contact_name" id="contact_name" value="<?= $supplier['contact_name'] ?? '' ?>">

    <label for="phone">Téléphone :</label>
    <input type="text" name="phone" id="phone" value="<?= $supplier['phone'] ?? '' ?>">

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" value="<?= $supplier['email'] ?? '' ?>">

    <label for="address">Adresse :</label>
    <input type="text" name="address" id="address" value="<?= $supplier['address'] ?? '' ?>">

    <button type="submit">Enregistrer</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
