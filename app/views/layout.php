<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="css/styles.css">
  <!-- Chart.js (pour les stats) -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <?php include __DIR__ . '/partials/header.php'; ?>
    <main>
        <?= $content ?? '' ?>
    </main>
    <?php include __DIR__ . '/partials/footer.php'; ?>
</div>

<script src="js/script.js"></script>
</body>
</html>
