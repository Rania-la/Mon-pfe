<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assurez-vous que les noms de colonnes correspondent à ceux de votre table
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $saveur = $_POST['saveur'];
    $type = $_POST['type'];
    $quantite = $_POST['quantite'];
    $extras = $_POST['extras'];

    // Prépare la requête SQL
    $sql = "INSERT INTO commandes_glaces (nom, email, adresse, telephone, date_commande, heure_commande, saveur, type, quantite, extras)
            VALUES (:nom, :email, :adresse, :telephone, NOW(), NOW(), :saveur, :type, :quantite, :extras)";

    // Utilisation de PDO pour préparer et exécuter la requête
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':saveur', $saveur);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':quantite', $quantite);
    $stmt->bindParam(':extras', $extras);

    // Exécute la requête
    if ($stmt->execute()) {
        // Redirection vers une page de confirmation ou autre page souhaitée après traitement
        header("Location: confirmation.php");
        exit();
    } else {
        echo "Erreur lors de l'insertion de la commande : " . $stmt->errorInfo()[2];
    }
}
?>
