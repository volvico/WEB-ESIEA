<?php
// Inclure le fichier contenant la classe UserManager
require_once 'functions/UserManager.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$validationMananger = new functions\ValidationManager();
// Créer une instance de la classe UserManager
$userManager = new functions\UserManager();

// Appeler la méthode getUserInfos pour récupérer les informations de l'utilisateur connecté
$userInfo = $userManager->getUserInfos($_SESSION['user_id']);

// Inclure le fichier contenant les parties du template
include_once 'templates/parts/header.php';
?>
<main>
    <section>
        <h1>Tableau de bord</h1>
        <!-- Afficher les informations de l'utilisateur connecté -->
        <?php           
            // Créer une instance de la classe UserManager
            $userManager = new functions\UserManager(); 
            // Récupérer l'ID de l'utilisateur à partir de la session ou d'une autre source
            $userID = $_SESSION['user_id'];
            // Appeler la fonction getUserInfos pour obtenir les informations de l'utilisateur
            $userInfo = $userManager->getUserInfos($userID);
            // Utiliser les informations récupérées
            echo "Nom: " . $userInfo['nom'];
            echo "Prénom: " . $userInfo['prenom'];
            echo "Adresse: " . $userInfo['adresse'];
            echo "Email: " . $userInfo['email'];
        ?>
        <!--Supprimer le compte -->
        <form action="index.php?action=close" method="post">
            <input type="hidden" name="csrf_token" value="<?= $validationMananger->sanitizeInput($_SESSION['csrf_token']); ?>">
            <button class="close-button" type="submit" name="delete_user">Supprimer mon compte</button>
        </form>
    </section>
</main>

<?php
include_once 'templates/parts/footer.php';
?>