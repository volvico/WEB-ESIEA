<?php
namespace functions;
require_once 'ValidationManager.php';
use functions\ValidationManager;
require_once 'UserManager.php';
use functions\UserManager;
/** Controller */


class UserController {
    private $validationManager;
    private $userManager;
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();    
        }
        $this->validationManager = new ValidationManager();
        $this->userManager = new UserManager();
    }

    public function handleRequest() {
        try {
            // Routes
            if (isset($_GET['action'])) {
                $action = $_GET['action'];        
                // Protection CSRF pour toutes les actions POST
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->validationManager->verifyCsrfToken();
                }

                switch ($action) {
                    case 'register':
                        $this->handleRegisterAction();
                        break;
                    case 'login':
                        $this->handleLoginAction();
                        break;
                    case 'dashboard':
                        include_once 'templates/dashboard.php';
                        break;
                    case 'update':
                        $this->handleUpdateAction();
                        break;
                    case 'close':
                        $this->handleCloseAction();
                        break;
                    case 'logout':
                        $this->handleLogoutAction();
                        break;
                    default:
                        include_once 'templates/home.php';
                        break;
                }
            } else {
                include_once 'templates/home.php';
            }
        } catch(\Exception $e) {
            $error_message = $e->getMessage();
            require_once 'templates/error.php';
        }
    }

    private function handleRegisterAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier le jeton CSRF
            $this->validationManager->verifyCsrfToken();
    
            // Récupérer les données du formulaire
            $nom = $this->validationManager->sanitizeInput($_POST['nom']);
            $prenom = $this->validationManager->sanitizeInput($_POST['prenom']);
            $adresse = $this->validationManager->sanitizeInput($_POST['adresse']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
    
            // Valider le formulaire
            $errors = $this->validationManager->validateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword);
    
            // Si des erreurs sont présentes, afficher le formulaire avec les erreurs
            if (!empty($errors)) {
                // Ajouter les erreurs au tableau de données pour les afficher dans le formulaire
                $data['errors'] = $errors;
                include_once 'templates/register.php';
            } else {
                // Appeler la fonction pour enregistrer l'utilisateur
                $error = $this->userManager->registerUser($nom, $prenom, $adresse, $email, $password, $confirmPassword);
    
                // Si l'enregistrement est réussi, rediriger vers la page de connexion
                if ($error === true) {
                    header("Location: index.php?action=login");
                    exit();
                } else {
                    // En cas d'erreur, afficher le message d'erreur sur la page d'inscription
                    // Ajouter le message d'erreur au tableau de données pour l'afficher dans le formulaire
                    $data['error'] = $error;
                    include_once 'templates/register.php';
                }
            }
        } else {
            // Afficher le formulaire d'inscription si la requête n'est pas de type POST
            include_once 'templates/register.php';
        }
    }

    private function handleLoginAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier le jeton CSRF ici avant d'appeler loginUser
            $this->validationManager->verifyCsrfToken();
    
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
    
            $error = $this->userManager->loginUser($email, $password);
    
            if($error === true){
                header("Location: index.php?action=dashboard");
                exit();
            } else {
                include_once 'templates/login.php';
            }
        } else {
            include_once 'templates/login.php';
        }
    }

    private function handleUpdateAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->validationManager->verifyCsrfToken();
    
            $id = $_SESSION['user_id'];
            $nom = $this->validationManager->sanitizeInput($_POST['nom']);
            $prenom = $this->validationManager->sanitizeInput($_POST['prenom']);
            $adresse = $this->validationManager->sanitizeInput($_POST['adresse']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
    
            $errors = $this->validationManager->validateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword);
    
            if (!empty($errors)) {
                $data['errors'] = $errors;
                include_once 'templates/update.php';
            } else {
    
                $error = $this->userManager->updateUserInfo($id, $nom, $prenom,$adresse, $email, $password, $confirmPassword);
    
                if ($error === true) {
                    header("Location: index.php?action=dashboard");
                    exit();
                } else {
                    include_once 'templates/update.php';
                }
            }
    
        } else {
            include_once 'templates/update.php';
        }
    }

    private function handleCloseAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user_id'];
    
            $this->validationManager->verifyCsrfToken();
    
            $this->userManager->closeAccount($id);
    
            session_destroy();
    
            header("Location: index.php");
            exit();
        }
    }

    private function handleLogoutAction() {
        // Détruire la session
    session_destroy();

    // Rediriger vers la page d'accueil
    header("Location: index.php");
    exit();
    }
}
?>
