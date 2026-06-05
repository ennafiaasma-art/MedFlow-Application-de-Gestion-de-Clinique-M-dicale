<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Repository/admin_repository.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$dbConnection = Database::getInstance();
$repository = new AdminRepository($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    if (isset($_POST['action']) && $_POST['action'] === 'add_doctor') {

        $doctor_name     = trim($_POST['doctor_name'] ?? '');
        $doctor_email    = trim($_POST['email'] ?? ''); 
        $doctor_password = $_POST['password'] ?? '';
        $specialite_id   = (int)($_POST['specialite_id'] ?? 0);

        if (
            !empty($doctor_name) &&
            !empty($doctor_email) &&
            !empty($doctor_password) &&
            $specialite_id > 0
        ) {

            
            $result = $repository->createDoctor(
                $doctor_name,
                $doctor_email,
                $doctor_password,
                $specialite_id
            );

            if ($result) {
                $_SESSION['success_message'] = "Le compte du Dr. " . htmlspecialchars($doctor_name) . " a été créé avec succès.";
            } else {
                $_SESSION['error_message'] = "Erreur lors de la création du médecin. L'email est peut-être déjà utilisé.";
            }

        } else {
            $_SESSION['error_message'] = "Veuillez remplir tous les champs correctement.";
        }

      
        header('Location: ../../templates/admin/dashboard.php');
        exit();
    }
}

    
    if (
        isset($_POST['action']) &&
        $_POST['action'] === 'update_doctor'
    ) {

        $doctor_id     = (int)($_POST['doctor_id'] ?? 0);
        $doctor_name   = trim($_POST['doctor_name'] ?? '');
        $specialite_id = (int)($_POST['specialite_id'] ?? 0);

        if (
            $doctor_id > 0 &&
            !empty($doctor_name) &&
            $specialite_id > 0
        ) {

            $result = $repository->updateDoctor(
                $doctor_id,
                $doctor_name,
                $specialite_id
            );

            if ($result) {
                $_SESSION['success_message'] =
                    "Médecin modifié avec succès.";
            } else {
                $_SESSION['error_message'] =
                    "Erreur lors de la modification.";
            }

        } else {
            $_SESSION['error_message'] =
                "Données invalides.";
        } 


if (isset($_POST['action']) && $_POST['action'] === 'change_status') {
    $doctor_id = (int)($_POST['doctor_id'] ?? 0);
    $new_status = trim($_POST['status'] ?? 'actif');

    if ($doctor_id > 0) {
        $stmt = $dbConnection->prepare("UPDATE doctor SET status = ? WHERE id_doctor = ?");
        $result = $stmt->execute([$new_status, $doctor_id]);

        if ($result) {
            $_SESSION['success_message'] = "Statut du médecin mis à jour.";
        } else {
            $_SESSION['error_message'] = "Erreur lors du changement de statut.";
        }
    }
    header('Location: ../../templates/admin/dashboard.php');
    exit();
}

        header('Location: ../../templates/admin/dashboard.php');
        exit();
    }

   
    if (
        isset($_POST['action']) &&
        $_POST['action'] === 'delete_doctor'
    ) {

        $user_id = (int)($_POST['user_id'] ?? 0);

        if ($user_id > 0) {

            $result = $repository->deleteDoctor($user_id);

            if ($result) {
                $_SESSION['success_message'] =
                    "Médecin supprimé avec succès.";
            } else {
                $_SESSION['error_message'] =
                    "Erreur lors de la suppression.";
            }

        } else {
            $_SESSION['error_message'] =
                "ID médecin invalide.";
        }

        header('Location: ../../templates/admin/dashboard.php');
        exit();
    }

    if (isset($_POST['add_specialite'])) {

        $specialite_name =
            trim($_POST['specialite_name'] ?? '');

        if (!empty($specialite_name)) {

            $result = $repository->createSpecialite(
                $specialite_name
            );

            if ($result) {
                $_SESSION['success_message'] =
                    "Spécialité ajoutée avec succès.";
            } else {
                $_SESSION['error_message'] =
                    "Erreur lors de l'ajout.";
            }

        } else {
            $_SESSION['error_message'] =
                "Nom de spécialité obligatoire.";
        }

        header('Location: ../../templates/admin/dashboard.php');
        exit();
    }

    if (
        isset($_POST['action']) &&
        $_POST['action'] === 'delete_specialite'
    ) {

        $specialite_id =
            (int)($_POST['specialite_id'] ?? 0);

        if ($specialite_id > 0) {

            $result =
                $repository->deleteSpecialite(
                    $specialite_id
                );

            if ($result) {
                $_SESSION['success_message'] =
                    "Spécialité supprimée avec succès.";
            } else {
                $_SESSION['error_message'] =
                    "Erreur lors de la suppression.";
            }

        } else {
            $_SESSION['error_message'] =
                "ID spécialité invalide.";
        }

        header('Location: ../../templates/admin/dashboard.php');
        exit();
    }
}

header('Location: ../../templates/admin/dashboard.php');
exit();