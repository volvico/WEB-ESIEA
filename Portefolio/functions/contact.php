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
<h1>PAGE DE CONTACT</h1>
    <nav>
        <div class="first">
            <a class="categoriesMenu" href="../index.php">Accueil</a>
            <a class="categoriesMenu" href="inscription.php">Inscription</a>
            <a class="categoriesMenu" href="connexion.php">Connexion</a>
            <a class="categoriesMenu" href="contact.php">Contact</a>
        </div>
    </nav>

<h2>FORMULAIRE DE CONTACT</h2>
<form action="contact.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required><br>
    <label for="email">Adresse e-mail :</label>
    <input type="email" id="email" name="email" required><br>
    <label for="description">Decrivez votre probleme :</label>
    <input type="text" id="description" name="description" size="140" required><br>
    <button type="submit">Envoyer votre demande</button>
</form>
</body>
<?php 
include '../templates/parts/footer.php'; 
?>