<?php
session_start();

// Inclure le fichier de configuration et le modèle
include 'config.php';
include 'model.php';
?>

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
    <div>
    <h1>PAGE DE CONNEXION</h1>
        <br>
        <form action="connexion.php" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required><br>
            <label for="motDePasse">Mot de passe:</label>
            <input type="password" id="motDePasse" name="motDePasse" required><br>
            <button type="submit">Verifier</button><br>
        </form>
        <div id="result"></div>
        <br>
<?php      
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = htmlspecialchars($_POST["email"]);
    $motDePasse = htmlspecialchars($_POST["motDePasse"]);

    // Valider les données
    if (empty($email) || empty($motDePasse)) {
        echo "Veuillez saisir votre adresse e-mail et votre mot de passe.";
    } else {
        // Instancier le modèle
        $model = new Model($connexion);

        // Vérifier les identifiants de connexion
        $user = $model->getUserByEmail($email);
        if ($user && password_verify($motDePasse, $user['mot_de_passe'])) {
            ?>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <?php
            // Identifiants valides, rediriger vers l'espace client
            header("Location: compte_client.php"); // Rediriger vers la page du compte client
            exit();
        } else {
            // Identifiants invalides, afficher un message d'erreur
            echo "Identifiants de connexion invalides. Veuillez réessayer.";
        }
    }
}
?>
        <br>
        <a href="inscription.php">Pas encore inscrit ? C'est ici.</a>
    </div>
    <br>
</body>
<?php 
include '../templates/parts/footer.php'; 
?>
</html>
