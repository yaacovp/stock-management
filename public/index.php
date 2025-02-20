<?php
session_start();

require_once '../config/config.php';

require_once '../app/controllers/DashboardController.php';
require_once '../app/controllers/StockController.php';
require_once '../app/controllers/SejourController.php';
require_once '../app/controllers/ImportController.php';
require_once '../app/controllers/SupplierController.php';
require_once '../app/controllers/BudgetController.php';
require_once '../app/controllers/StatsController.php';

$action = $_GET['action'] ?? 'choose_sejour';

$allowedActionsWithoutSejour = [
    'choose_sejour',
    'init_sejour',
    'sejour',
    'sejour_form',
    'sejour_save',
    'sejour_delete'
];

if (!isset($_SESSION['sejour_id']) && !in_array($action, $allowedActionsWithoutSejour)) {
    $action = 'choose_sejour';
}

$dashboardController = new DashboardController();
$stockController     = new StockController();
$sejourController    = new SejourController();
$importController    = new ImportController();
$supplierController  = new SupplierController();
$budgetController    = new BudgetController();
$statsController     = new StatsController();

switch ($action) {
    case 'choose_sejour':
        $sejourController->chooseSejour();
        break;
    case 'init_sejour':
        $sejourController->initSejour();
        break;
    case 'sejour':
        $sejourController->index();
        break;
    case 'sejour_form':
        $sejourController->form();
        break;
    case 'sejour_save':
        $sejourController->save();
        break;
    case 'sejour_delete':
        $sejourController->delete();
        break;
    
    case 'dashboard':
        $dashboardController->index();
        break;

    case 'stock':
        $stockController->index();
        break;
    case 'stock_form':
        $stockController->form();
        break;
    case 'stock_save':
        $stockController->save();
        break;
    case 'stock_delete':
        $stockController->delete();
        break;

    case 'import':
        $importController->form();
        break;
    case 'import_upload':
        $importController->upload();
        break;

    case 'suppliers':
        $supplierController->index();
        break;
    case 'supplier_form':
        $supplierController->form();
        break;
    case 'supplier_save':
        $supplierController->save();
        break;
    case 'supplier_delete':
        $supplierController->delete();
        break;

    case 'budget':
        $budgetController->index();
        break;
    case 'budget_form':
        $budgetController->form();
        break;
    case 'budget_save':
        $budgetController->save();
        break;

    case 'stats':
        $statsController->index();
        break;

    default:
        if (!isset($_SESSION['sejour_id'])) {
            $sejourController->chooseSejour();
        } else {
            $dashboardController->index();
        }
        break;
}
