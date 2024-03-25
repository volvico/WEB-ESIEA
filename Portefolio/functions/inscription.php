<?php
session_start();
// Inclure le fichier de configuration et le modèle
include 'config.php';
include 'model.php';
?>
<html>
<body>
<div class="imageContainers"><img class="logo" src="../templates/assets/img/logovrai.png" alt="Logo de votre site" width="10%"></div>
<link rel="stylesheet" href="../templates/assets/css/style/style.css">
    <nav>
        <div class="first">
            <a class="categoriesMenu" href="../index.php">Accueil</a>
            <a class="categoriesMenu" href="inscription.php">Inscription</a>
            <a class="categoriesMenu" href="connexion.php">Connexion</a>
            <a class="categoriesMenu" href="contact.php">Contact</a>
        </div>
    </nav>

    <h1>PAGE D'INSCRIPTION</h1>
<form action="inscription.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required><br>
    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" required><br>
    <label for="motDePasse">Mot de passe :</label>
    <input type="password" id="motDePasse" name="motDePasse" required><br>
    <button type="submit">S'inscrire</button>
</form>

<?php

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $motDePasse = $_POST["motDePasse"];

    // Valider les données
    if (empty($nom) || empty($prenom) || empty($email) || empty($motDePasse)) {
        echo "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "L'adresse e-mail n'est pas valide.";
    } else {
        // Hacher le mot de passe
        $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

        // Instancier le modèle
        $model = new Model($connexion);

        // Vérifier si l'utilisateur existe déjà
        if ($model->getUserByEmail($email)) {
            echo "L'adresse e-mail est déjà utilisée. Veuillez choisir une autre adresse e-mail.";
        } else {
            // Insérer l'utilisateur dans la base de données
            $resultat = $model->createUser($nom, $prenom, $email, $motDePasseHash, 'client');

            if ($resultat) {
                echo "Inscription réussie !";
                header("Location: compte_client.php"); // Rediriger vers la page du compte client
                // exit();
            } else {
                echo "Erreur lors de l'inscription. Veuillez réessayer.";
            }
        }
    }
}
?>
<br>
<a href="connexion.php">Deja inscrit ? Connectez-vous.</a>

</body>
<?php 
include '../templates/parts/footer.php'; 
?>
</html>
