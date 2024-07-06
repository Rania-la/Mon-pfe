<?php
include 'config2.php';

// Requête pour sélectionner toutes les commandes de glaces
$sql = "SELECT * FROM commandes_glaces2";
$stmt = $pdo->query($sql);

if ($stmt === false) {
    // Gestion des erreurs SQL
    echo "Erreur SQL : " . print_r($pdo->errorInfo(), true);
} else {
    // Début de la sortie HTML
    echo "<html>";
    echo "<head>";
    echo "<title>Espace Admin</title>";
    // Inclusion de Bootstrap CSS (exemple de lien CDN)
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
    // Styles CSS personnalisés pour la barre de navigation jaune
    echo '<style>';
    echo '.yellow-navbar { background-color: #ffc107; color: #000; }';
    echo '</style>';
    echo "</head>";
    echo "<body>";
    
    // Barre de navigation Bootstrap jaune
    echo '<nav class="navbar navbar-expand-lg navbar-light yellow-navbar">';
    echo '<a class="navbar-brand" href="#">IceFrais</a>';
    echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
    echo '<span class="navbar-toggler-icon"></span>';
    echo '</button>';
    
    echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
    echo '<ul class="navbar-nav mr-auto">';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="">Liste des Commandes</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="ajouter_article.php">Ajouter Article</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="Supprimer_article.php">Supprimer Article</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="#">Modifier Article</a>';
    echo '</li>';
    echo '</ul>';

    // Bouton de déconnexion à droite
    echo '<ul class="navbar-nav">';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="déconnexion.php">Déconnexion</a>';
    echo '</li>';
    echo '</ul>';
    
    echo '</div>';
    echo '</nav>';

    // Tableau des commandes
    echo "<div class='container mt-4'>";
    echo "<h2>Liste des Commandes</h2>";
    echo "<table class='table'>";
    echo "<thead class='thead-light'>";
    echo "<tr><th>ID</th><th>Nom Produit</th><th>Prix</th><th>Email</th><th>Adresse Livraison</th><th>Méthode de Paiement</th><th>Date de Commande</th></tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['nom_produit']."</td>";
        echo "<td>".$row['prix']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['adresse_livraison']."</td>";
        echo "<td>".$row['methode_paiement']."</td>";
        echo "<td>".$row['date_commande']."</td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    // Inclusion de Bootstrap JavaScript (facultatif, pour les fonctionnalités comme le dropdown)
    echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>';
    echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';

    // Fin de la sortie HTML
    echo "</body>";
    echo "</html>";
}
?>
