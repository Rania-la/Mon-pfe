<?php
include 'config.php'; // Incluez votre fichier de configuration

// Vérification de la session admin (à adapter selon votre système de gestion de sessions)
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirection vers la page de connexion si l'admin n'est pas connecté
    header("Location: login.php");
    exit;
}

// Ici, vous pouvez placer d'autres vérifications d'autorisation ou récupérer d'autres données nécessaires à l'administration

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin - Accueil</title>
    <!-- Inclusion de Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Styles personnalisés si nécessaires -->
    <style>
        /* Ajoutez ici vos styles personnalisés */
    </style>
</head>
<body>

<!-- Barre de navigation Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Espace Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="accueil_admin.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="liste_commandes.php">Liste des Commandes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ajouter_article.php">Ajouter Article</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="supprimer_article.php">Supprimer Article</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="modifier_article.php">Modifier Article</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Contenu de l'accueil pour l'espace admin -->
<div class="container mt-4">
    <div class="jumbotron">
        <h1 class="display-4">Bienvenue dans l'Espace Admin</h1>
        <p class="lead">Vous êtes connecté en tant qu'administrateur. Utilisez la barre de navigation pour accéder aux différentes fonctionnalités.</p>
        <hr class="my-4">
        <p>Vous pouvez gérer les commandes, ajouter, supprimer ou modifier des articles, et plus encore.</p>
    </div>
</div>

<!-- Inclusion de Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
