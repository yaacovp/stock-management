<?php
require_once __DIR__ . '/../models/BudgetModel.php';
require_once __DIR__ . '/../models/SejourModel.php';

class BudgetController
{
    public function index() {
        // Récupère le sejour_id depuis l’URL (GET)
        // Exemple : ?action=budget&sejour_id=1
        // Si rien n’est défini, on regarde la session, ou 0 pour “tous”
        $sejour_id = isset($_GET['sejour_id']) ? (int)$_GET['sejour_id'] : ($_SESSION['sejour_id'] ?? 0);

        // Récupérer la liste de tous les séjours pour le <select>
        $sejours = SejourModel::getAll();

        // Récupérer les dépenses filtrées par sejour_id
        // Si sejour_id = 0 => on prend tous
        $expenses = BudgetModel::getAll($sejour_id);

        // Afficher la vue
        require __DIR__ . '/../views/budget_list.php';
    }

    public function form() {
        // Pour créer une nouvelle dépense
        // On peut avoir besoin de la liste des séjours
        require_once __DIR__ . '/../models/SejourModel.php';
        $sejours = SejourModel::getAll();

        require __DIR__ . '/../views/budget_form.php';
    }

    public function save() {
        $data = [
            'sejour_id' => (int)($_POST['sejour_id'] ?? 0),
            'category'  => $_POST['category'] ?? '',
            'amount'    => (float)($_POST['amount'] ?? 0),
            'date'      => $_POST['date'] ?? date('Y-m-d'),
            'notes'     => $_POST['notes'] ?? ''
        ];
        BudgetModel::create($data);
        header('Location: index.php?action=budget');
        exit;
    }
}
