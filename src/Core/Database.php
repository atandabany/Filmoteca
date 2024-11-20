<?php

class Database
{
    private $pdo;

    public function __construct()
    {
        try {
            // Construire le DSN à partir des variables d'environnement
            $dsn = "mysql:host=localhost;dbname={$_ENV['MYSQL_DATABASE']};charset=utf8mb4";

            // Créer une instance de PDO
            $this->pdo = new PDO(
                $dsn,
                $_ENV['MYSQL_USER'],
                $_ENV['MYSQL_PASSWORD']
            );

            // Configurer PDO
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gestion des erreurs
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
