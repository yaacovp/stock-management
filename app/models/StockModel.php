<?php
require_once __DIR__ . '/DB.php';

class StockModel
{
    public static function getAll($sejour_id = 0, $search = '', $category = '', $belowThreshold = false, $sortBy = 'name', $order = 'asc')
    {
        $pdo = DB::getConnection();
        $sql = "SELECT * FROM products WHERE 1=1 ";
        $params = [];

        if ($sejour_id > 0) {
            $sql .= "AND sejour_id = :sid ";
            $params[':sid'] = $sejour_id;
        }

        if (!empty($search)) {
            $sql .= "AND (name LIKE :search OR category LIKE :search) ";
            $params[':search'] = "%$search%";
        }

        if (!empty($category)) {
            $sql .= "AND category = :cat ";
            $params[':cat'] = $category;
        }

        if ($belowThreshold) {
            $sql .= "AND quantity < threshold_alert ";
        }

        $allowedSort = ['name', 'price', 'quantity', 'threshold_alert'];
        if (!in_array($sortBy, $allowedSort)) {
            $sortBy = 'name';
        }

        $allowedOrder = ['asc', 'desc'];
        if (!in_array($order, $allowedOrder)) {
            $order = 'asc';
        }

        $sql .= "ORDER BY $sortBy $order";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getProductNames()
    {
        $pdo = DB::getConnection();
        $stmt = $pdo->query("SELECT DISTINCT name FROM products ORDER BY name ASC");
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function getCategories()
    {
        $pdo = DB::getConnection();
        $stmt = $pdo->query("SELECT DISTINCT category FROM products ORDER BY category ASC");
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }


    public static function getById($id)
    {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = DB::getConnection();
        $sql = "INSERT INTO products
            (name, category, quantity, threshold_alert, price, unit, sejour_id)
            VALUES
            (:name, :category, :quantity, :threshold_alert, :price, :unit, :sejour_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'            => $data['name'],
            ':category'        => $data['category'],
            ':quantity'        => $data['quantity'],
            ':threshold_alert' => $data['threshold_alert'],
            ':price'           => $data['price'],
            ':unit'            => $data['unit'],
            ':sejour_id'       => $data['sejour_id'] ?? 0
        ]);
    }

    public static function update($id, $data)
    {
        $pdo = DB::getConnection();
        $sql = "UPDATE products SET
                 name = :name,
                 category = :category,
                 quantity = :quantity,
                 threshold_alert = :threshold_alert,
                 price = :price,
                 unit = :unit,
                 sejour_id = :sejour_id
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'            => $data['name'],
            ':category'        => $data['category'],
            ':quantity'        => $data['quantity'],
            ':threshold_alert' => $data['threshold_alert'],
            ':price'           => $data['price'],
            ':unit'            => $data['unit'],
            ':sejour_id'       => $data['sejour_id'],
            ':id'              => $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
