<?php ob_start(); ?>
<h1>Importer un fichier CSV ou XLSX</h1>

<form method="post" action="index.php?action=import_upload" enctype="multipart/form-data">
    <label for="file">Fichier :</label>
    <input type="file" name="file" id="file" accept=".csv, .xlsx" required>
    
    <button type="submit">Importer</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
?>
