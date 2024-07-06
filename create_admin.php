<?php
include 'config.php';

$username = 'admin';
$password = 'ABC123'; // Changez ceci par votre mot de passe souhaité
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $hashed_password);

if ($stmt->execute()) {
    echo "Administrateur créé avec succès.";
} else {
    echo "Erreur lors de la création de l'administrateur.";
}
?>
