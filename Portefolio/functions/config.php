<?php
// Paramètres de configuration de la base de données
$DB_HOST = 'localhost'; // Hôte de la base de données
$DB_USER = 'root'; // Nom d'utilisateur de la base de données
$DB_PASSWORD = 'Victor2002'; // Mot de passe de la base de données
$DB_NAME = 'portfolio'; // Nom de la base de données

// Créer une connexion à la base de données avec MySQLi
$connexion = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Erreur de connexion à la base de données : " . $connexion->connect_error);
}

function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

function verifyCsrfToken() {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Erreur CSRF token. Les jetons ne correspondent pas. " . json_encode($_POST));
    }
}

function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }

    return $_SESSION['csrf_token'];
}
?>
