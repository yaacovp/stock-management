<?php
require_once __DIR__ . '/../models/StockModel.php';
require 'libs/PhpSpreadsheet/src/Bootstrap.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController
{
    public function upload() {
        if (!empty($_FILES['file']['tmp_name'])) {
            $file = $_FILES['file']['tmp_name'];
            $fileType = $_FILES['file']['type'];
            $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

            if ($fileExtension === 'csv') {
                $this->importCsv($file);
            } elseif ($fileExtension === 'xlsx') {
                $this->importXlsx($file);
            } else {
                die("Format non pris en charge !");
            }
        }
        header('Location: index.php?action=stock');
        exit;
    }

    private function importCsv($file) {
        $handle = fopen($file, 'r');
        if ($handle !== false) {
            fgetcsv($handle); // Ignorer l'en-tête

            while (($row = fgetcsv($handle, 1000, ';')) !== false) {
                $data = [
                    'name'            => $row[0] ?? '',
                    'category'        => $row[1] ?? '',
                    'quantity'        => (int)($row[2] ?? 0),
                    'threshold_alert' => (int)($row[3] ?? 0),
                    'price'           => (float)($row[4] ?? 0),
                    'unit'            => $row[5] ?? ''
                ];
                StockModel::create($data);
            }
            fclose($handle);
        }
    }

    private function importXlsx($file) {
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Ignorer l'en-tête
        array_shift($rows);

        foreach ($rows as $row) {
            $data = [
                'name'            => $row[0] ?? '',
                'category'        => $row[1] ?? '',
                'quantity'        => (int)($row[2] ?? 0),
                'threshold_alert' => (int)($row[3] ?? 0),
                'price'           => (float)($row[4] ?? 0),
                'unit'            => $row[5] ?? ''
            ];
            StockModel::create($data);
        }
    }
}
