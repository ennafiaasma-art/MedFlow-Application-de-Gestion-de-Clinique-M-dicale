<?php

require_once __DIR__ . "/Env.php";

Env::load(__DIR__ . "/src/.env");

class Database
{
    private static ?PDO $instance = null;

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {

            try {

                self::$instance = new PDO(
                    "mysql:host=" . $_ENV['DB_HOST'] .
                    ";dbname=" . $_ENV['DB_NAME'] .
                    ";charset=utf8mb4",
                    $_ENV['DB_USER'],
                    $_ENV['DB_PASS']
                );

                self::$instance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                self::$instance->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {

                die("Connexion échouée : " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}