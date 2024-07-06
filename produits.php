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

    <div class="row">
        <?php
        // Inclusion du fichier de configuration de la base de données
        include 'config.php';

        // Requête SQL pour sélectionner tous les produits
        $sql = "SELECT * FROM glace";
        $stmt = $pdo->query($sql);

        // Affichage des produits
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="images/<?php echo $row['photo']; ?>" class="card-img-top" alt="<?php echo $row['saveur']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['saveur']; ?></h5>
                        <p class="card-text">Prix : <?php echo $row['prix']; ?> DH</p>
                        <p class="card-text">Catégorie : <?php echo $row['categorie']; ?></p>
                        <a href="index.html#commandez" class="btn btn-primary" onclick="addToCartAndRedirectPay4(<?php echo $row['id']; ?>)">
                            <i class="fas fa-shopping-cart"></i> Ajouter au panier
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function addToCartAndRedirectPay4(productId) {
        // Simule l'ajout au panier (à remplacer par votre logique d'ajout au panier réelle)
        addToCart(productId);

        // Redirection vers la partie "commandez" sur la page index.html
        window.location.href = 'index.html#commandez';
    }

    function addToCart(productId) {
        // Vous pouvez implémenter ici la logique pour ajouter au panier
        // Par exemple, envoyer une requête AJAX ou simplement un message d'alerte comme ci-dessous
        alert('Produit ajouté au panier !');
    }
</script>


<script>
    function addToCart(productId) {
        // Vous pouvez implémenter ici la logique pour ajouter au panier
        // Par exemple, envoyer une requête AJAX ou simplement un message d'alerte comme ci-dessous
        alert('Produit ajouté au panier !');
    }
</script>

</body>
</html>
