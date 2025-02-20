<?php
require_once __DIR__ . '/../models/SupplierModel.php';

class SupplierController
{
    public function index() {
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $suppliers = SupplierModel::getAll($search);
        require __DIR__ . '/../views/supplier_list.php';
    }
}
