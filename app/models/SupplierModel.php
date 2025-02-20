
<?php
require_once __DIR__ . '/DB.php';

class SupplierModel
{
    public static function getAll($search = null) {
        $pdo = DB::getConnection();
        $sql = "SELECT * FROM suppliers WHERE 1=1 ";
        $params = [];
        if (!empty($search)) {
            $sql .= "AND (name LIKE :search OR contact_name LIKE :search) ";
            $params[':search'] = "%$search%";
        }
        $sql .= "ORDER BY id DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM suppliers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("
            INSERT INTO suppliers (name, contact_name, phone, email, address)
            VALUES (:name, :contact_name, :phone, :email, :address)
        ");
        $stmt->execute([
            ':name'         => $data['name'],
            ':contact_name' => $data['contact_name'],
            ':phone'        => $data['phone'],
            ':email'        => $data['email'],
            ':address'      => $data['address']
        ]);
    }

    public static function update($id, $data) {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("
            UPDATE suppliers
            SET name = :name,
                contact_name = :contact_name,
                phone = :phone,
                email = :email,
                address = :address
            WHERE id = :id
        ");
        $stmt->execute([
            ':id'           => $id,
            ':name'         => $data['name'],
            ':contact_name' => $data['contact_name'],
            ':phone'        => $data['phone'],
            ':email'        => $data['email'],
            ':address'      => $data['address']
        ]);
    }

    public static function delete($id) {
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("DELETE FROM suppliers WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
