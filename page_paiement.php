<?php
include 'config.php'; // Inclure le fichier de configuration pour se connecter à la base de données

// Récupérer l'ID de la commande depuis l'URL
$orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($orderId > 0) {
    // Préparer la requête pour récupérer les détails de la commande
    $sql = "SELECT * FROM commandes_glaces2 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
    $stmt->execute();

    // Récupérer les détails de la commande
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$order) {
    echo "Commande non trouvée.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de paiement</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: url('D8.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .payment-page {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .order-details {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .order-details ul {
            list-style: none;
            padding: 0;
        }

        .order-details ul li {
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container payment-page">
        <h1 class="mt-5 text-center">Merci de finaliser votre commande</h1>
        <br>
        <h4>Détails de la commande :</h4>
        <ul>
            <li>Produit: <?php echo isset($order['nom_produit']) ? htmlspecialchars($order['nom_produit']) : ''; ?></li>
            <li>Prix: <?php echo isset($order['prix']) ? htmlspecialchars($order['prix']) . ' DH' : ''; ?></li>
            <li>Email: <?php echo isset($order['email']) ? htmlspecialchars($order['email']) : ''; ?></li>
            <li>Adresse de livraison: <?php echo isset($order['adresse_livraison']) ? htmlspecialchars($order['adresse_livraison']) : ''; ?></li>
        </ul>

        <form action="process2payment.php" method="post">
            <input type="hidden" name="orderId" value="<?php echo $orderId; ?>">
            <div class="form-group">
                <label for="paymentMethod">Méthode de paiement:</label>
                <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                    <option value="">Sélectionner une méthode</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Adresse :</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="street">Rue :</label>
                <input type="text" class="form-control" id="street" name="street" required>
            </div>
            <div class="form-group">
                <label for="postalCode">Code Postal :</label>
                <input type="text" class="form-control" id="postalCode" name="postalCode" required>
            </div>
            <div class="form-group">
                <label for="cardName">Nom sur la carte :</label>
                <input type="text" class="form-control" id="cardName" name="cardName" required>
            </div>
            <div class="form-group">
                <label for="cardNumber">Numéro de la carte :</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
            </div>
            <div class="form-group">
                <label for="expiryDate">Date d'expiration :</label>
                <input type="text" class="form-control" id="expiryDate" name="expiryDate" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV :</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            <button type="submit" class="btn btn-primary">Payer</button>
        </form>
    </div>
</body>
</html>
