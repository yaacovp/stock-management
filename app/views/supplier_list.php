
<?php ob_start(); ?>
<h1>Fournisseurs</h1>

<form method="get" class="filter-form">
    <input type="hidden" name="action" value="suppliers">
    <label for="search">Recherche :</label>
    <input type="text" name="search" id="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    <button type="submit">Filtrer</button>
</form>

<a class="btn" href="index.php?action=supplier_form">Ajouter un fournisseur</a>

<table class="table-stock">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Contact</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($suppliers as $sup): ?>
        <tr>
            <td><?= htmlspecialchars($sup['name']) ?></td>
            <td><?= htmlspecialchars($sup['contact_name']) ?></td>
            <td><?= htmlspecialchars($sup['phone']) ?></td>
            <td><?= htmlspecialchars($sup['email']) ?></td>
            <td><?= htmlspecialchars($sup['address']) ?></td>
            <td>
                <a href="index.php?action=supplier_form&id=<?= $sup['id'] ?>">Modifier</a>
                <a href="index.php?action=supplier_delete&id=<?= $sup['id'] ?>"
                   onclick="return confirm('Supprimer ce fournisseur ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
