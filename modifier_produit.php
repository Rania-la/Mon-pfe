<?php
// Inclusion du fichier de configuration de la base de données
include 'config.php';

// Vérification du paramètre de succès pour afficher un message si nécessaire
$successMessage = '';
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $successMessage = '<div class="alert alert-success" role="alert">Le produit a été modifié avec succès.</div>';
}

// Requête SQL pour sélectionner tous les produits
$sql = "SELECT * FROM glace";
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits - Espace Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .yellow-navbar {
            background-color: #ffc107;
            color: #000;
        }
    </style>
</head>
<body>

<!-- Barre de navigation Bootstrap jaune -->
<nav class="navbar navbar-expand-lg navbar-light yellow-navbar">
    <a class="navbar-brand" href="#">IceFrais</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Liste des Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ajouter_produit.php">Ajouter Produit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="liste_commandes.php">Liste des Commandes</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="deconnexion.php">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Contenu principal -->
<div class="container mt-5">
    <h2>Liste des Produits</h2>

    <?php echo $successMessage; ?>

    <table class="table">
        <thead>
        <tr>
            <th>Saveur</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Affichage des produits
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['saveur'] . "</td>";
            echo "<td>" . $row['prix'] . " DH</td>";
            echo "<td>" . $row['categorie'] . "</td>";
            echo "<td><a href='Modifier.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Modifier</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Inclusion de Bootstrap JavaScript (facultatif, pour les fonctionnalités comme le dropdown) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
