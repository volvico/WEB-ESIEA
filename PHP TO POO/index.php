<?php
include_once 'templates/parts/header.php';
// Importer la classe Controller
require_once 'functions/controller.php';
// Instancier un objet de la classe Controller
$controller = new functions\UserController();
// Appeler la méthode handleRequest sur l'objet Controller
$controller->handleRequest();
// Inclure le reste du code de votre page
include_once 'templates/parts/footer.php';
?>
