<?php
// Configuration de la base de données
$dsn = 'mysql:host=localhost;dbname=pfe';
$username = 'root';
$password = '';

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO($dsn, $username, $password);
    // Définir le mode d'erreur PDO à Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    die(); // Arrêter le script en cas d'échec de connexion
}
?>
