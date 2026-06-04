<?php

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Repository/admin_repository.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$dbConnection = Database::getInstance();
$repository = new admin_repository($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'update_doctor') {
        
        $doctor_id     = (int)($_POST['doctor_id'] ?? 0);
        $doctor_name   = trim($_POST['doctor_name'] ?? '');
        $specialite_id = (int)($_POST['specialite_id'] ?? 0);
        $doctor_status = trim($_POST['doctor_status'] ?? 'actif');

        if ($doctor_id > 0 && !empty($doctor_name) && $specialite_id > 0) {
            
            $isUpdated = $repository->updateDoctor($doctor_id, $doctor_name, $specialite_id, $doctor_status);

            if ($isUpdated) {
                $_SESSION['success_message'] = "Le profil du médecin (Dr. " . htmlspecialchars($doctor_name) . ") a été modifié avec succès !";
            } else {
                $_SESSION['error_message'] = "Une erreur est survenue lors de la modification.";
            }
            
        } else {
            $_SESSION['error_message'] = "Veuillez vérifier les informations. Tous les champs sont obligatoires.";
        }

        header('Location: ../../templates/admin/dashboard.php');
        exit();
    }

    if (isset($_POST['action']) && $_POST['action'] === 'delete_specialite') {
        
        $specialite_name = trim($_POST['specialite_name'] ?? '');

        if (!empty($specialite_name)) {
            
            $isDeleted = $repository->deleteSpécialité($specialite_name);

            if ($isDeleted) {
                $_SESSION['success_message'] = "La spécialité a été supprimée avec succès !";
            } else {
                $_SESSION['error_message'] = "Impossible de supprimer la spécialité (liée à des médecins).";
            }
        } else {
            $_SESSION['error_message'] = "Nom de spécialité invalide.";
        }

        header('Location: ../../templates/admin/dashboard.php');
        exit();
    }

    if (isset($_POST['doctor_name']) && !isset($_POST['action'])) { 
        
        $doctor_name     = trim($_POST['doctor_name'] ?? '');
        $doctor_email    = trim($_POST['email'] ?? '');
        $doctor_password = $_POST['password'] ?? '';
        $specialite_id   = isset($_POST['specialite_id']) ? (int)$_POST['specialite_id'] : 0;
        $statut          = trim($_POST['status'] ?? 'actif'); // جلب الحالة من الفورم

        if (!empty($doctor_name) && !empty($doctor_email) && !empty($doctor_password) && $specialite_id > 0) {
            
            $result = $repository->createDoctor($doctor_name, $doctor_email, $doctor_password, $specialite_id, $statut);

            if ($result) {
                $_SESSION['success_message'] = "Le compte du Dr. " . htmlspecialchars($doctor_name) . " a été créé avec succès !";
            } else {
                $_SESSION['error_message'] = "Erreur de création. L'adresse email est peut-être déjà utilisée.";
            }
        } else {
            $_SESSION['error_message'] = "Veuillez remplir tous les champs obligatoires (*) !";
        }

        header('Location: ../../templates/admin/dashboard.php');
        exit();
    }

    if (isset($_POST['add_specialite'])) {
        $name_specialite = htmlspecialchars(trim($_POST['specialite_name'] ?? ''));

        if (empty($name_specialite)) {
            $_SESSION['error_message'] = "Le nom de la spécialité ne peut pas être vide.";
            header('Location: ../../templates/admin/dashboard.php');
            exit(); 
        }
        
        $succ = $repository->creatSpécialité($name_specialite);

        if ($succ) {
            $_SESSION['success_message'] = "La spécialité a été ajoutée avec succès !";
        } else {
            $_SESSION['error_message'] = "Erreur lors de l'enregistrement de la spécialité.";
        }
        header('Location: ../../templates/admin/dashboard.php');
        exit();
    }

$specialites = $adminRepository->getSpecialities();

require_once "../../views/admin/dashboard.php";
}

header('Location: ../../templates/admin/dashboard.php');
exit();