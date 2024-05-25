<?php

// Paramètres de connexion à la base de données
$host = 'localhost';
$dbName = 'shopping_cart';
$port = 3306;
$charset = 'utf8';
$username = 'root';
$password = '';

// Construction de la chaîne DSN pour PDO
$dsn = "mysql:host=$host;dbname=$dbName;port=$port;charset=$charset";

try {
    // Création d'une connexion PDO
    $objectPDO = new PDO($dsn, $username, $password);
    
    // Configuration des attributs PDO pour gérer les erreurs
    $objectPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
     // Si la connexion est réussie, afficher un message
     //echo "Connexion réussie à la base de données '$dbName' sur le port $port.";
    } catch (PDOException $e) {
        // Si la connexion échoue, afficher le message d'erreur
        die("Échec de la connexion : " . $e->getMessage());
    }

?>