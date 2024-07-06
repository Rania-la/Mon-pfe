<?php
// Inclusion du fichier de configuration de la base de données
include 'config.php';

// Récupération de l'ID du produit à modifier depuis l'URL
$id = $_GET['id'];

// Récupération des détails du produit depuis la base de données
$sql = "SELECT * FROM glace WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    // Gérer le cas où aucun produit n'est trouvé avec cet ID
    echo "Produit non trouvé.";
    exit();
}
// Vérification de l'envoi du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $id = htmlspecialchars($_POST['id']);
    $saveur = htmlspecialchars($_POST['saveur']);
    $prix = htmlspecialchars($_POST['prix']);
    $categorie = htmlspecialchars($_POST['categorie']);
    $nouvellePhoto = $_FILES['nouvelle_photo']; // Récupération du fichier photo optionnel
    // Vérification et traitement du fichier photo
if (!empty($nouvellePhoto['name'])) {
    // ... traitement du fichier photo ici ...
}

// Extension autorisée pour les images
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Vérification et traitement de la nouvelle photo
    if (!empty($nouvellePhoto['name'])) {
        $photoName = $nouvellePhoto['name'];
        $photoTmp = $nouvellePhoto['tmp_name'];
        $photoSize = $nouvellePhoto['size'];
        $photoError = $nouvellePhoto['error'];
        $photoExtension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

        if (in_array($photoExtension, $allowedExtensions)) {
            // Supprimer l'ancienne photo du serveur si nécessaire (à implémenter selon vos besoins)

            // Nom unique pour la nouvelle photo
            $photoNewName = uniqid('article_') . '.' . $photoExtension;
            // Chemin où enregistrer la nouvelle photo
            $photoDestination = 'images/' . $photoNewName;

            // Déplacer le fichier téléchargé vers le dossier images
            if (move_uploaded_file($photoTmp, $photoDestination)) {
                // Mettre à jour la base de données avec la nouvelle photo
                $sql = "UPDATE glace SET saveur = :saveur, prix = :prix, photo = :photo, categorie = :categorie WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':saveur', $saveur);
                $stmt->bindParam(':prix', $prix);
                $stmt->bindParam(':photo', $photoNewName);
                $stmt->bindParam(':categorie', $categorie);
                $stmt->bindParam(':id', $id);

                if ($stmt->execute()) {
                    // Redirection après la modification
                    $_SESSION['message'] = "Le produit a été modifié avec succès.";
                    header('Location: produits.php');
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour du produit : " . print_r($stmt->errorInfo(), true);
                }
            } else {
                echo "Erreur lors de l'upload de la nouvelle photo.";
            }
        } else {
            echo "Extension de fichier non autorisée pour la nouvelle photo.";
        }
    } else {
        // Si aucune nouvelle photo n'est téléchargée, mettre à jour sans la photo
        $sql = "UPDATE glace SET saveur = :saveur, prix = :prix, categorie = :categorie WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':saveur', $saveur);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':categorie', $categorie);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Redirection après la modification
            $_SESSION['message'] = "Le produit a été modifié avec succès.";
            header('Location: produits.php');
            exit();
        } else {
            echo "Erreur lors de la mise à jour du produit : " . print_r($stmt->errorInfo(), true);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Article - Espace Admin</title>
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
                <a class="nav-link" href="liste_commandes.php">Liste des Commandes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="produits.php">Retour aux Produits</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="deconnexion.php">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Section pour modifier un article -->
<section class="ftco-section" id="modifier_article">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="heading-section ftco-animate text-center">
                    <h2 class="mb-4">Modifier un Article</h2>
                </div>
                <form method="post" enctype="multipart/form-data" class="appointment-form ftco-animate">
                    <input type="hidden" name="id" value="<?php echo $produit['id']; ?>">
                    <div class="form-group">
                        <label for="saveur">Saveur</label>
                        <input type="text" class="form-control" id="saveur" name="saveur" value="<?php echo $produit['saveur']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" class="form-control" id="prix" name="prix" value="<?php echo $produit['prix']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <select class="form-control" id="categorie" name="categorie" required>
                            <option value="Cornet" <?php if ($produit['categorie'] == 'Cornet') echo 'selected'; ?>>Cornet</option>
                            <option value="Pot" <?php if ($produit['categorie'] == 'Pot') echo 'selected'; ?>>Pot</option>
                            <option value="Glace pour Fêtes" <?php if ($produit['categorie'] == 'Glace pour Fêtes') echo 'selected'; ?>>Glace pour Fêtes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo actuelle</label><br>
                        <img src="images/<?php echo $produit['photo']; ?>" alt="<?php echo $produit['saveur']; ?>" style="max-width: 200px;">
                    </div>
                    <div class="form-group">
                        <label for="nouvelle_photo">Nouvelle Photo (optionnel)</label>
                        <input type="file" class="form-control-file" id="nouvelle_photo" name="nouvelle_photo" accept="image/*">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<!-- Inclusion de Bootstrap JavaScript (facultatif, pour les fonctionnalités comme le dropdown) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php

?>