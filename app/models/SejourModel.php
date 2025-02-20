<?php
require_once __DIR__ . '/../../config/database.php';

class SejourModel
{
    public static function getAll()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM sejours ORDER BY start_date DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM sejours WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $pdo = Database::getConnection();
        // Retirer `photo`
        $sql = "INSERT INTO sejours (name, start_date, end_date)
                VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['name'],
            $data['start_date'],
            $data['end_date']
        ]);
    }

    public static function update($id, $data)
    {
        $pdo = Database::getConnection();
        // Retirer `photo`
        $sql = "UPDATE sejours
                SET name = ?,
                    start_date = ?,
                    end_date = ?
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['name'],
            $data['start_date'],
            $data['end_date'],
            $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM sejours WHERE id = ?");
        $stmt->execute([$id]);
    }
}
