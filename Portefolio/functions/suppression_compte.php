<?php
session_start();
?>
<html>
    <body>
    <div class="imageContainers"><img class="logo" src="../templates/assets/img/logovrai.png" alt="Logo de votre site" width="10%"></div>
    <link rel="stylesheet" href="../templates/assets/css/style/style.css">
    <h1>SUPPRESSION DU COMPTE</h1>
    <nav>
        <div class="first">
            <a class="categoriesMenu" href="../index.php">Accueil</a>
            <a class="categoriesMenu" href="projets.php">Projets</a>
            <a class="categoriesMenu" href="contact.php">Contact</a>
            <a class="categoriesMenu" href="deconnexion.php">Deconnexion</a>
        </div>
    </nav>
    <h2>Tu es sur de vouloir supprimer ton compte ?</h2>
    <div>
<form action="supprimer.php" method="post">
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required><br>
    <label for="motDePasse">Mot de passe:</label>
    <input type="password" id="motDePasse" name="motDePasse" required><br>
    <p></p>
    <button type="submit">Oui, supprimer mon compte</button><br>
</form>

    <form action="compte_client.php">
        <button type="submit">Non, revenir sur mon espace personnel</button>
    </form>
    </div>
</body>
<?php 
include '../templates/parts/footer.php'; 
?>
</html>