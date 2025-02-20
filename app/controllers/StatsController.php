<?php
require_once __DIR__ . '/../models/StockModel.php';
require_once __DIR__ . '/../models/BudgetModel.php';

class StatsController
{
    public function index()
    {
        $sejour_id = $_SESSION['sejour_id'] ?? 0;

        // Si tu veux forcer un séjour validé
        if ($sejour_id <= 0) {
            header('Location: index.php?action=choose_sejour');
            exit;
        }

        // Récupère les produits filtrés
        $products = StockModel::getAll($sejour_id);

        // Regroupement par catégorie
        $categoryStats = [];
        foreach ($products as $p) {
            $cat = $p['category'];
            if (!isset($categoryStats[$cat])) {
                $categoryStats[$cat] = 0;
            }
            $categoryStats[$cat] += $p['quantity'];
        }

        // Récupère les dépenses filtrées
        $expenses = BudgetModel::getAll($sejour_id);

        // Regroupement par catégorie (montant)
        $expenseStats = [];
        foreach ($expenses as $e) {
            $cat = $e['category'];
            if (!isset($expenseStats[$cat])) {
                $expenseStats[$cat] = 0;
            }
            $expenseStats[$cat] += $e['amount'];
        }

        // Vue
        require __DIR__ . '/../views/stats_view.php';
    }
}
