<?php ob_start(); ?>
<h1>Gestion du Stock Hôtelier</h1>

<form method="get" class="filter-form">
    <input type="hidden" name="action" value="stock">

    <label for="search">Recherche :</label>
    <input type="text" name="search" id="search" value="<?= htmlspecialchars($search ?? '') ?>" list="productList">
    <datalist id="productList">
        <?php foreach ($productNames as $pn): ?>
            <option value="<?= htmlspecialchars($pn) ?>">
        <?php endforeach; ?>
    </datalist>

    <label for="category">Catégorie :</label>
    <select name="category" id="category">
        <option value="">Toutes</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat ?>" <?= ($category ?? '') === $cat ? 'selected' : '' ?>><?= htmlspecialchars($cat) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="below_threshold">
        <input type="checkbox" name="below_threshold" id="below_threshold" <?= !empty($_GET['below_threshold']) ? 'checked' : '' ?>>
        En dessous du seuil ?
    </label>

    <button type="submit">Filtrer</button>
</form>

<a class="btn" href="index.php?action=stock_form">➕ Ajouter un produit</a>

<?php if (!empty($products)): ?>
    <div class="table-responsive">
        <table class="table-stock">
            <thead>
                <tr>
                    <?php
                    function sort_link($column, $sort_by, $order) {
                        $new_order = ($order === 'asc') ? 'desc' : 'asc';
                        $icon = ($sort_by === $column) ? ($order === 'asc' ? '🔼' : '🔽') : '🔼';
                        return "<a href='index.php?action=stock&sort_by=$column&order=$new_order' class='sortable'>$column <span>$icon</span></a>";
                    }
                    ?>
                    <th><?= sort_link('name', $sortBy, $order) ?></th>
                    <th><?= sort_link('category', $sortBy, $order) ?></th>
                    <th><?= sort_link('quantity', $sortBy, $order) ?></th>
                    <th>Unité</th>
                    <th><?= sort_link('threshold_alert', $sortBy, $order) ?></th>
                    <th><?= sort_link('price', $sortBy, $order) ?></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($products as $p): ?>
                <tr class="<?= ($p['quantity'] < $p['threshold_alert']) ? 'alert-row' : '' ?>">
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['category']) ?></td>
                    <td><?= $p['quantity'] ?></td>
                    <td><?= htmlspecialchars($p['unit']) ?></td>
                    <td><?= $p['threshold_alert'] ?></td>
                    <td><?= number_format($p['price'], 2) ?> €</td>
                    <td>
                      <a class="btn" href="index.php?action=stock_form&id=<?= $p['id'] ?>">✏ Modifier</a>
                      <a class="btn btn-danger"
                         href="index.php?action=stock_delete&id=<?= $p['id'] ?>"
                         onclick="return confirm('Supprimer ce produit ?');">
                         ❌ Supprimer
                      </a>
                    </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>Aucun produit trouvé.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
?>
