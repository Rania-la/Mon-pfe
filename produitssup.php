<?php
// Inclusion du fichier de configuration de la base de données
include 'config.php';

// Requête SQL pour récupérer tous les produits
$sql = "SELECT * FROM glace";
$stmt = $pdo->query($sql);

// Vérification s'il y a des produits récupérés
if ($stmt) {
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $produits = []; // Initialisation d'un tableau vide si aucune donnée n'est récupérée
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Liste des Produits</h2>

    <?php foreach ($produits as $produit) : ?>
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="images/<?php echo $produit['photo']; ?>" class="card-img" alt="<?php echo $produit['saveur']; ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $produit['saveur']; ?></h5>
                        <p class="card-text">Prix : <?php echo $produit['prix']; ?> DH</p>
                        <p class="card-text">Catégorie : <?php echo $produit['categorie']; ?></p>
                        <a href="supprimer_produit.php?id=<?php echo $produit['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
