<!-- Supprimer_article.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer Article - IceFrais</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Supprimer un Article</h2>
    <form method="post" action="Supprimer_article.php">
        <div class="form-group">
            <label for="saveur">Nom de la Saveur à Supprimer :</label>
            <input type="text" class="form-control" id="saveur" name="saveur" placeholder="Entrez la saveur">
        </div>
        <button type="submit" name="submit" class="btn btn-danger">Supprimer l'Article</button>
    </form>
</div>

<?php
// Supprimer_article.php

// Inclure le fichier de configuration de la base de données
include 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $saveur = $_POST['saveur'];

    // Requête SQL pour supprimer l'article par saveur
    $sql_delete = "DELETE FROM glace WHERE saveur = :saveur";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(':saveur', $saveur);

    // Exécuter la requête de suppression
    if ($stmt_delete->execute()) {
        echo '<div class="alert alert-success mt-3" role="alert">L\'article a été supprimé avec succès.</div>';
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">Erreur lors de la suppression de l\'article.</div>';
    }
}
?>

</body>
</html>
