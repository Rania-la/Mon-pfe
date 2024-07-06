<?php
session_start();
include 'db.php';

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $session_id = session_id(); // Utilisez l'ID de session pour identifier le panier de l'utilisateur

    // Vérifier si le produit est déjà dans le panier
    $sql = "SELECT * FROM cart WHERE session_id='$session_id' AND product_id='$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si le produit est déjà dans le panier, augmenter la quantité
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + 1;
        $sql = "UPDATE cart SET quantity='$new_quantity' WHERE session_id='$session_id' AND product_id='$product_id'";
        $conn->query($sql);
    } else {
        // Sinon, ajouter le produit au panier
        $sql = "INSERT INTO cart (session_id, product_id, quantity) VALUES ('$session_id', '$product_id', 1)";
        $conn->query($sql);
    }

    header('Location: payment.php'); // Redirige vers la page de paiement
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <!-- Exemple de produit -->
            <div class="col-md-4">
                <div class="card">
                    <img src="image_du_produit.jpg" class="card-img-top" alt="Produit">
                    <div class="card-body">
                        <h5 class="card-title">Nom du produit</h5>
                        <p class="card-text">Prix: 10€</p>
                        <form method="post" action="add_to_cart.php">
                            <input type="hidden" name="product_id" value="1">
                            <button type="submit" name="add_to_cart" class="btn btn-primary">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Ajouter d'autres produits de la même manière -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
