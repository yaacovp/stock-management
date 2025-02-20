<?php
session_start();
require_once __DIR__ . '/../../models/SejourModel.php';

$sejoursHeader = SejourModel::getAll();
$currentSejourId = $_SESSION['sejour_id'] ?? 0;
?>
<nav class="navbar">
    <div class="nav-brand">
        <a href="index.php?action=dashboard"><?= APP_NAME ?></a>
    </div>

    <!-- Liens principaux à gauche -->
    <ul class="nav-links nav-left">
        <li><a href="index.php?action=dashboard">Dashboard</a></li>
        <li><a href="index.php?action=stock">Stock</a></li>
        <li><a href="index.php?action=import">Import CSV</a></li>
        <li><a href="index.php?action=suppliers">Fournisseurs</a></li>
        <li><a href="index.php?action=budget">Budget</a></li>
        <li><a href="index.php?action=stats">Statistiques</a></li>
    </ul>

    <!-- Liens à droite : Changer de séjour + Sélecteur -->
    <ul class="nav-links nav-right">
        <li>
            <a href="index.php?action=choose_sejour"
               class="btn-change-sejour"
               onclick="return confirm('Voulez-vous changer de séjour ?')">
               Changer de séjour
            </a>
        </li>

        <li class="sejour-select-container">
            <form method="get" class="sejour-mini-form">
                <input type="hidden" name="action" value="init_sejour">
                
                <label class="sejour-badge-label" for="sejourSelect">Séjour :</label>
                <select name="sejour_id" id="sejourSelect" class="sejour-badge" onchange="this.form.submit()">
                    <option value="0" <?= $currentSejourId == 0 ? 'selected' : '' ?>>-- Tous --</option>
                    <?php foreach ($sejoursHeader as $s): ?>
                        <option value="<?= $s['id'] ?>" <?= ($s['id'] == $currentSejourId) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </li>
    </ul>
</nav>
