<?php

$host = "localhost";
$dbname = "medflow";
$user = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie !";

} catch(PDOException $e) 
  {
    die("Erreur : " . $e->getMessage());
  }
?>
