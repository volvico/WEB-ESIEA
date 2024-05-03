<?php
namespace functions;
require_once 'ValidationManager.php';
/** Controller */

class DatabaseManager {
    private static $instance;
    private $pdo;
    public function __construct() {
        // Connexion à la base de données
        try {
            $this->pdo = new \PDO('mysql:host=localhost;dbname=esiea_web', 'root', 'Victor2002');
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception('Erreur lors de la connexion à la base de données : ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPdo() {
        return $this->pdo;
    }
}
?>