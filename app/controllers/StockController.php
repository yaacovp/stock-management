<?php
require_once __DIR__ . '/../models/StockModel.php';

class StockController
{
    public function index()
    {
        session_start();
        $sejour_id = $_SESSION['sejour_id'] ?? 0;

        $search         = $_GET['search'] ?? '';
        $category       = $_GET['category'] ?? '';
        $onlyBelowAlert = isset($_GET['below_threshold']) ? true : false;
        $sortBy         = $_GET['sort_by'] ?? 'name';
        $order          = $_GET['order'] ?? 'asc';

        $products = StockModel::getAll($sejour_id, $search, $category, $onlyBelowAlert, $sortBy, $order);
        $categories   = StockModel::getCategories();
        $productNames = StockModel::getProductNames();

        require __DIR__ . '/../views/stock_list.php';
    }

    public function form()
    {
        session_start();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $product = null;

        if ($id > 0) {
            $product = StockModel::getById($id);
            if (!$product) {
                header('Location: index.php?action=stock');
                exit;
            }
        }

        $categories = StockModel::getCategories();
        $units = ['kg', 'L', 'palette', 'pièce', 'pack'];

        require __DIR__ . '/../views/stock_form.php';
    }

    public function save()
    {
        session_start();
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        $data = [
            'name'            => $_POST['name'] ?? '',
            'category'        => $_POST['category'] ?? '',
            'quantity'        => (int)($_POST['quantity'] ?? 0),
            'threshold_alert' => (int)($_POST['threshold_alert'] ?? 0),
            'price'           => (float)($_POST['price'] ?? 0),
            'unit'            => $_POST['unit'] ?? 'pièce',
            'sejour_id'       => $_SESSION['sejour_id'] ?? 0
        ];

        if ($id > 0) {
            StockModel::update($id, $data);
        } else {
            StockModel::create($data);
        }
        header('Location: index.php?action=stock');
        exit;
    }

    public function delete()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0) {
            StockModel::delete($id);
        }
        header('Location: index.php?action=stock');
        exit;
    }
}
