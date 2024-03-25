<?php
session_start();
// Inclure le fichier de configuration et le modèle
include 'config.php';
include '../templates/parts/header.php';

// Vérifier si l'utilisateur est connecté (par exemple, en vérifiant une session)
// Si l'utilisateur n'est pas connecté, vous pouvez le rediriger vers la page de connexion

// Afficher le nom de l'utilisateur connecté et d'autres informations de son compte
// Vous pouvez également afficher d'autres informations de compte que vous avez dans votre base de données
?>
<body>
<div class="imageContainers"><img class="logo" src="../templates/assets/img/logovrai.png" alt="Logo de votre site" width="10%"></div>
<link rel="stylesheet" href="../templates/assets/css/style/style.css">
    <h1>ESPACE PERSONNEL</h1>
    <nav>
        <div class="first">
            <a class="categoriesMenu" href="../index.php">Accueil</a>
            <a class="categoriesMenu" href="contact.php">Contact</a>
            <a class="categoriesMenu" href="deconnexion.php">Deconnexion</a>
        </div>
        <h2>VOS PROJETS</h2>

        <div class="image">
        <img src="../templates/assets/img/licorne.png" alt="photo de licorne" width="30%">
        <img src="../templates/assets/img/licorne.png" alt="photo de licorne" width="30%">
        <img src="../templates/assets/img/licorne.png" alt="photo de licorne" width="30%">
        </div>

        <div class="nomProjet">
            <p>Projet 1</p>
            <p>Projet 2</p>
            <p>Projet 3</p>
        </div>

        <div class="image">
        <img src="../templates/assets/img/licorne.png" alt="photo de licorne" width="30%">
        <img src="../templates/assets/img/licorne.png" alt="photo de licorne" width="30%">
        <img src="../templates/assets/img/licorne.png" alt="photo de licorne" width="30%">
        </div>

        <div class="nomProjet">
            <p>Projet 4</p>
            <p>Projet 5</p>
            <p>Projet 6</p>
        </div>
    </nav>
    <!-- Afficher d'autres informations du compte client -->
<div>
    <form action="mise_a_jour.php" method="post">
            <button class="espaceClient" type="submit">Mettre vos informations a jour</button><br>
    </form>
    
    <!-- Ajouter d'autres éléments HTML et fonctionnalités de l'espace client selon vos besoins -->

    <form action="suppression_compte.php" method="post">
        <button class="espaceClient" type="submit">Supprimer le compte</button>
    </form>
</div>
</body>
<?php 
include '../templates/parts/footer.php'; 
?>
</html>
