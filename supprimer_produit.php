<?php
// Inclusion du fichier de configuration de la base de données
include 'config.php';

// Vérification de l'ID du produit à supprimer
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    // Préparation de la requête SQL pour supprimer le produit
    $sql = "DELETE FROM glace WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    // Exécution de la requête
    if ($stmt->execute()) {
        // Redirection vers la liste des produits avec un message de succès
        $_SESSION['message'] = "Le produit a été supprimé avec succès.";
        header('Location: produitssup.php');
        exit();
    } else {
        // Gestion des erreurs
        echo "Erreur lors de la suppression du produit : " . print_r($stmt->errorInfo(), true);
    }
} else {
    // Redirection si l'ID du produit n'est pas spécifié
    header('Location: produitssup.php');
    exit();
}
?>
