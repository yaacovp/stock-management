<?php ob_start(); ?>
<h1>Statistiques</h1>

<div class="charts-container">
    <div>
        <canvas id="stockChart"></canvas>
    </div>
    <div>
        <canvas id="expenseChart"></canvas>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Données pour le stock par catégorie
    const categoryLabels = <?= json_encode(array_keys($categoryStats)) ?>;
    const categoryValues = <?= json_encode(array_values($categoryStats)) ?>;

    const ctx1 = document.getElementById('stockChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Quantité totale',
                data: categoryValues,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Stock total par catégorie'
                }
            }
        }
    });

    // Données pour les dépenses par catégorie
    const expenseLabels = <?= json_encode(array_keys($expenseStats)) ?>;
    const expenseValues = <?= json_encode(array_values($expenseStats)) ?>;

    const ctx2 = document.getElementById('expenseChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: expenseLabels,
            datasets: [{
                label: 'Dépenses',
                data: expenseValues,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 205, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Dépenses par catégorie'
                }
            }
        }
    });
});
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';
