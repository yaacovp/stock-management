<?php
require_once __DIR__ . '/DB.php';

class BudgetModel
{
    public static function getAll($sejour_id = 0)
    {
        $pdo = DB::getConnection();

        if ($sejour_id > 0) {
            // Filtre par séjour
            $sql = "SELECT * FROM expenses WHERE sejour_id = :sid ORDER BY date DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':sid' => $sejour_id]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } else {
            // 0 => toutes les dépenses
            $sql = "SELECT * FROM expenses ORDER BY date DESC";
            $stmt = $pdo->query($sql);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public static function create($data)
    {
        $pdo = DB::getConnection();
        $sql = "INSERT INTO expenses (sejour_id, category, amount, date, notes)
                VALUES (:sejour_id, :category, :amount, :date, :notes)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':sejour_id' => $data['sejour_id'],
            ':category'  => $data['category'],
            ':amount'    => $data['amount'],
            ':date'      => $data['date'],
            ':notes'     => $data['notes']
        ]);
    }
}
