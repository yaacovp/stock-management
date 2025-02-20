<?php
$editing = ($product !== null);
ob_start();
?>
<h1><?= $editing ? 'Modifier un produit' : 'Ajouter un produit' ?></h1>

<form method="post" action="index.php?action=stock_save">
    <?php if ($editing): ?>
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <?php endif; ?>

    <label for="name">Nom :</label>
    <input type="text" id="name" name="name" required value="<?= htmlspecialchars($product['name'] ?? '') ?>">

    <label for="category">Catégorie :</label>
    <select name="category" id="category">
        <?php foreach ($categories as $cat): ?>
            <option value="<?= htmlspecialchars($cat) ?>" <?= ($editing && $product['category'] == $cat) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="quantity">Quantité :</label>
    <input type="number" id="quantity" name="quantity" required value="<?= $product['quantity'] ?? 0 ?>">

    <label for="unit">Unité :</label>
    <select name="unit" id="unit">
        <?php foreach (['kg', 'L', 'palette', 'pièce', 'pack'] as $u): ?>
            <option value="<?= htmlspecialchars($u) ?>" <?= ($editing && $product['unit'] == $u) ? 'selected' : '' ?>>
                <?= htmlspecialchars($u) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="threshold_alert">Seuil d'alerte :</label>
    <input type="number" id="threshold_alert" name="threshold_alert" required value="<?= $product['threshold_alert'] ?? 0 ?>">

    <label for="price">Prix unitaire :</label>
    <input type="number" step="0.01" id="price" name="price" required value="<?= $product['price'] ?? 0 ?>">

    <div class="form-buttons">
        <button type="submit">Enregistrer</button>
        <a href="index.php?action=stock" class="btn btn-secondary btn-annule">Annuler</a>
    </div>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
