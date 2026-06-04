
<?php
require_once __DIR__ . '/../Repository/Admin_Repository.php';
require_once __DIR__ . '/../../config/database.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class AdminController 
{
    private $adminRepository;
    public function __construct() 
    {
        $db = Database::getInstance();      
        $this->adminRepository = new admin_repository($db);
    }

    public function dashboard() 
    {
        $tauxAnnulation = $this->adminRepository->createSpeciality();
        $medecins = $this->adminRepository->getAllDoctors();
    }
    public function addDoctor()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = isset($_POST['nom']) ? trim(htmlspecialchars($_POST['nom'])) : '';
            $email = isset($_POST['email']) ? trim(htmlspecialchars($_POST['email'])) : '';
            $specialite_id = isset($_POST['specialite_id']) ? intval($_POST['specialite_id']) : 0;
            $statut = isset($_POST['statut']) ? trim(htmlspecialchars($_POST['statut'])) : 'actif';

            $errors = [];

            if (empty($nom)) {
                $errors['nom'] ="le mon de doctore est obligaloire.";
            }

            if (empty($email)) {
                $errors['email'] ="email de doctore est obligaloire.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "email incorrect !";
            }

            if ($specialite_id <= 0) {
                $errors['specialite'] = "spécialité est obligatoire !";
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old_inputs'] = $_POST; 
                header('Location: /admin/dashboard?modal=add-doctor');
                exit();
            }

            $success = $this->adminRepository->createDoctor($nom, $email, $specialite_id, $statut);

            if ($success) {
            $_SESSION['success_message'] = "ajouter médcin avec succeé";
            } else {
                $_SESSION['error_message'] = "error !";
            }

            header('Location: /admin/dashboard');
            exit();
        }
    }

    public function addSpeciality()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom_specialite = isset($_POST['nom_specialite']) ? trim(htmlspecialchars($_POST['nom_specialite'])) : '';
            $description = isset($_POST['description']) ? trim(htmlspecialchars($_POST['description'])) : '';

            $errors = [];

            if (empty($nom_specialite)) {
                $errors['nom_specialite'] = "le mon de doctore est obligaloire";
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old_inputs'] = $_POST;
                header('Location: /admin/dashboard?modal=add-speciality');
                exit();
            }

            $success = $this->adminRepository->createSpeciality($nom_specialite, $description);

            if ($success) {
                $_SESSION['success_message'] = "success";
            } else {
                $_SESSION['error_message'] = "error";
            }

            header('Location: /admin/dashboard');
            exit();
        }
    }
}





