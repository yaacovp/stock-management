<?php
ob_start();
?>
<h1>Gestion des Séjours</h1>

<!-- Bouton Retour à la sélection des séjours -->
<a class="btn btn-secondary" href="index.php?action=choose_sejour">
    ⬅ Retour à la sélection des séjours
</a>

<!-- Bouton pour créer un nouveau séjour -->
<a class="btn" href="index.php?action=sejour_form">
    ➕ Créer un nouveau séjour
</a>

<table class="table-stock">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php if (!empty($sejours)): ?>
        <?php foreach($sejours as $s): ?>
            <tr>
                <td><?= htmlspecialchars($s['name']) ?></td>
                <td><?= $s['start_date'] ?></td>
                <td><?= $s['end_date'] ?></td>
                <td>
                    <!-- Modifier -->
                    <a class="btn" href="index.php?action=sejour_form&id=<?= $s['id'] ?>">
                        ✏ Modifier
                    </a>
                    <!-- Supprimer -->
                    <a class="btn btn-danger" href="index.php?action=sejour_delete&id=<?= $s['id'] ?>"
                       onclick="return confirm('Supprimer ce séjour ? Cette action sera irréversible');">
                       ❌ Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">Aucun séjour enregistré.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
