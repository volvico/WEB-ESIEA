<?php

include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $motDePasse = htmlspecialchars($_POST["motDePasse"]);

    $user = verifyUser($username, $motDePasse);

    if ($user) {
        echo "<br> Utilisateur existant !<br>";
        echo "<br> Nom: " . htmlspecialchars($user["nom"]) . "<br>";
        echo "<br> Date de naissance: " . htmlspecialchars($user["date de naissance"]) . "<br>";
        echo "<br> Email: " . htmlspecialchars($user["email"]) . "<br>";
        echo "<br> Occupation: " . htmlspecialchars($user["occupation"]);
        echo "Emploi du temps: <img src='" . htmlspecialchars($user["Emploi du temps"]) . "' alt='Emploi du temps'><br>";
    } else {
        echo "Identifiants incorrects. Veuillez reessayer.";
    }
}

?>