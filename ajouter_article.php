<?php
// Inclusion du fichier de configuration de la base de données
include 'config.php';

// Vérification de l'envoi du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $saveur = htmlspecialchars($_POST['saveur']); // Échapper les caractères spéciaux HTML
    $prix = htmlspecialchars($_POST['prix']);
    $categorie = htmlspecialchars($_POST['categorie']);
    $photo = $_FILES['photo']; // Récupération du fichier photo

    // Vérification et traitement du fichier photo
    $photoName = $photo['name'];
    $photoTmp = $photo['tmp_name'];
    $photoSize = $photo['size'];
    $photoError = $photo['error'];

    // Extension autorisée pour les images
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $photoExtension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

    // Vérifier si l'extension est autorisée
    if (in_array($photoExtension, $allowedExtensions)) {
        // Nom unique pour la photo
        $photoNewName = uniqid('article_') . '.' . $photoExtension;
        // Chemin où enregistrer la photo (assurez-vous que le dossier 'images' existe)
        $photoDestination = 'images/' . $photoNewName;

        // Déplacer le fichier téléchargé vers le dossier images
        if (move_uploaded_file($photoTmp, $photoDestination)) {
            // Préparation de la requête SQL d'insertion avec photo et catégorie
            $sql = "INSERT INTO glace (saveur, prix, photo, categorie) VALUES (:saveur, :prix, :photo, :categorie)";
            $stmt = $pdo->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':saveur', $saveur);
            $stmt->bindParam(':prix', $prix);
            $stmt->bindParam(':photo', $photoNewName);
            $stmt->bindParam(':categorie', $categorie);

            // Exécution de la requête
            if ($stmt->execute()) {
                // Message de succès
                $_SESSION['message'] = "Le produit a été ajouté avec succès.";

                // Redirection vers la page des produits après l'ajout avec un paramètre de succès
                header('Location: produits.php');
                exit();
            } else {
                // Gestion des erreurs d'exécution de la requête
                echo "Erreur d'insertion : " . print_r($stmt->errorInfo(), true);
            }
        } else {
            echo "Erreur lors de l'upload de la photo.";
        }
    } else {
        echo "Extension de fichier non autorisée. Les extensions autorisées sont : jpg, jpeg, png, gif.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Article - Espace Admin</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="#">Ajouter Article</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="deconnexion.php">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Section pour ajouter un article -->
<section class="ftco-section" id="ajouter_article">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="heading-section ftco-animate text-center">
                    <h2 class="mb-4">Ajouter un Article</h2>
                </div>
                <form method="post" enctype="multipart/form-data" class="appointment-form ftco-animate">
                    <div class="form-group">
                        <label for="saveur">Saveur</label>
                        <input type="text" class="form-control" id="saveur" name="saveur" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" class="form-control" id="prix" name="prix" required>
                    </div>
                    <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <select class="form-control" id="categorie" name="categorie" required>
                            <option value="Cornet">Cornet</option>
                            <option value="Pot">Pot</option>
                            <option value="Glace pour Fêtes">Glace pour Fêtes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
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
