<html>
<body>
<div class="imageContainers"><img class="logo" src="../templates/assets/img/logovrai.png" alt="Logo de votre site" width="10%"></div>
<link rel="stylesheet" href="../templates/assets/css/style/style.css">
<h1>SUPPRESSION DU COMPTE</h1>
    <nav>
        <div class="first">
            <a class="categoriesMenu" href="../index.php">Accueil</a>
            <a class="categoriesMenu" href="inscription.php">Inscription</a>
            <a class="categoriesMenu" href="connexion.php">Connexion</a>
            <a class="categoriesMenu" href="Contact.html">Contact</a>
        </div>
    </nav>
<?php
// Inclure le fichier de configuration
include 'config.php';
include 'Model.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST["email"];
    $motDePasse = $_POST["motDePasse"];

    // Valider les données
    if (empty($email) || empty($motDePasse)) {
        echo "Veuillez saisir l'ID de l'utilisateur et son mot de passe.";
    } else {
        // Établir une connexion à la base de données
        $connexion = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

        // Vérifier la connexion
        if ($connexion->connect_error) {
            die("Erreur de connexion à la base de données : " . $connexion->connect_error);
        }

        // Préparer la requête SQL pour récupérer le mot de passe de l'utilisateur
        $sql = "SELECT mot_de_passe FROM utilisateurs WHERE id = ?";

        // Préparer la déclaration
        $stmt = $connexion->prepare($sql);

        // Lier les paramètres
        $stmt->bind_param("s", $email);

        // Exécuter la requête
        $stmt->execute();

        // Lier le résultat de la requête à une variable
        $stmt->bind_result($mot_de_passe_db);

        // Récupérer le résultat de la requête
        $stmt->fetch();

        // Instancier le modèle
        $model = new Model($connexion);

        $user = $model->getUserByEmail($email);
        if ($user && password_verify($motDePasse, $user['mot_de_passe'])) {
            // Le mot de passe est correct, procéder à la suppression du compte

            // Supprimer l'utilisateur de la base de données
            $success = $model->deleteUserByEmail($email);

            // Vérifier si la suppression s'est bien déroulée
            if ($success) {
                echo "Le compte a été supprimé avec succès.";
            } else {
                echo "Une erreur s'est produite lors de la suppression du compte. Veuillez réessayer.";
            }
        } else {
            // Le mot de passe est incorrect, afficher un message d'erreur
            echo "Le mot de passe fourni est incorrect. Veuillez réessayer.";
        }

        // Fermer les déclarations et la connexion à la base de données
        $connexion->close();
    }
}
?>
 <br>
        <a href="inscription.php">Vous pouvez toujours vous reinscrire ici</a>
    </div>
    <br>
</body>
<?php 
include '../templates/parts/footer.php'; 
?>
</html>

