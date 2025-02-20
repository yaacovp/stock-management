<?php
require_once __DIR__ . '/../models/SejourModel.php';

class SejourController
{
    public function chooseSejour()
    {
        session_start();
        if (isset($_SESSION['sejour_id'])) {
            unset($_SESSION['sejour_id']);
        }
        $sejours = SejourModel::getAll();
        require __DIR__ . '/../views/sejour_choose.php';
    }

    public function initSejour()
    {
        session_start();
        if (isset($_GET['sejour_id'])) {
            $id = (int)$_GET['sejour_id'];
            if ($id === 0) {
                // 0 => Tous
                $_SESSION['sejour_id'] = 0;
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                $sejour = SejourModel::getById($id);
                if ($sejour) {
                    $_SESSION['sejour_id'] = $id;
                    header('Location: index.php?action=dashboard');
                    exit;
                }
            }
        }
        header('Location: index.php?action=choose_sejour');
        exit;
    }

    public function index()
    {
        session_start();
        $sejours = SejourModel::getAll();
        require __DIR__ . '/../views/sejour_list.php';
    }

    public function form()
    {
        session_start();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $sejour = null;

        if ($id > 0) {
            $sejour = SejourModel::getById($id);
            if (!$sejour) {
                header('Location: index.php?action=sejour');
                exit;
            }
        }
        require __DIR__ . '/../views/sejour_form.php';
    }

    /**
     * Crée ou met à jour un séjour (sans photo).
     */
    public function save()
    {
        session_start();
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        // Vérif champs obligatoires
        if (!empty($_POST['name']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
            $data = [
                'name'       => trim($_POST['name']),
                'start_date' => $_POST['start_date'],
                'end_date'   => $_POST['end_date']
            ];

            if ($id > 0) {
                // Update
                SejourModel::update($id, $data);
            } else {
                // Create
                SejourModel::create($data);
            }
            header('Location: index.php?action=sejour');
            exit;
        } else {
            $error = "Tous les champs sont obligatoires.";
            $sejour = ($id > 0) ? SejourModel::getById($id) : null;
            require __DIR__ . '/../views/sejour_form.php';
        }
    }

    public function delete()
    {
        session_start();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0) {
            SejourModel::delete($id);
        }
        header('Location: index.php?action=sejour');
        exit;
    }
}
