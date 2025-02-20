<?php
require_once __DIR__ . '/../models/StockModel.php';
require_once __DIR__ . '/../models/SejourModel.php';

class DashboardController
{
    public function index()
    {
        session_start();

        // 1) Récupérer le sejour_id depuis GET si on change le séjour
        if (isset($_GET['sejour_id'])) {
            $sejour_id = (int)$_GET['sejour_id'];
            // Mettre à jour la session
            $_SESSION['sejour_id'] = $sejour_id;
        } else {
            // Sinon on prend la session, par défaut 0 (Tous)
            $sejour_id = $_SESSION['sejour_id'] ?? 0;
        }

        // 2) Récupérer la liste de tous les séjours (pour le <select>)
        $sejours = SejourModel::getAll();

        // 3) Récupérer les produits
        //    Si $sejour_id > 0, on filtre, sinon on affiche tout
        $products = StockModel::getAll($sejour_id);

        // 4) Calculer stats
        $totalProducts = count($products);
        $alertCount = count(array_filter($products, function($p) {
            return $p['quantity'] < $p['threshold_alert'];
        }));

        // 5) Affichage
        require __DIR__ . '/../views/dashboard.php';
    }
}
