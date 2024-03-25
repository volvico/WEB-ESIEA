<?php

class Model {
    private $connexion;

    public function __construct($db) {
        $this->connexion = $db;
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM utilisateurs WHERE adresse_mail=?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // CREATE : Ajouter un nouvel utilisateur
    public function createUser($nom, $prenom, $email, $motDePasse, $role) {
        $sql = "INSERT INTO utilisateurs (nom, prenom, adresse_mail, mot_de_passe, role) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bind_param("sssss", $nom, $prenom, $email, $motDePasse, $role);
        return $stmt->execute();
    }

    // READ : Récupérer tous les utilisateurs
    public function getAllUsers() {
        $sql = "SELECT * FROM utilisateurs";
        $result = $this->connexion->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // UPDATE : Mettre à jour un utilisateur existant
    public function updateUser($id, $nom, $prenom, $email, $motDePasse, $role) {
        $sql = "UPDATE utilisateurs SET nom=?, prenom=?, adresse_mail=?, mot_de_passe=?, role=? WHERE id=?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bind_param("sssssi", $nom, $prenom, $email, $motDePasse, $role, $id);
        return $stmt->execute();
    }

    // Méthode pour supprimer un utilisateur en fonction de son email
    public function deleteUserByEmail($email) {
        $sql = "DELETE FROM utilisateurs WHERE adresse_mail = ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bind_param("s", $email);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}

?>
