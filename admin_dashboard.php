<?php
// Inclusion du fichier de configuration pour la connexion à la base de données
include 'config.php';

// Requête pour sélectionner toutes les commandes
$sql = "SELECT id, nom, email, adresse, telephone, date_commande, heure_commande, saveur_glace, type_glace, quantite, extras FROM commandes_glaces";

// Exécuter la requête et vérifier les erreurs
try {
    $stmt = $pdo->query($sql);
    if ($stmt === false) {
        echo "Erreur SQL : " . print_r($pdo->errorInfo(), true);
    } else {
        echo "<!DOCTYPE html>";
        echo "<html lang='fr'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Espace Admin - Liste des Commandes</title>";
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
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
        echo '<a class="nav-link" href="#">Liste des Commandes</a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="ajouter_article.php">Ajouter Produit</a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="modifier_produit.php">Modifier Produit</a>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="supprimer_produit.php">Supprimer Produit</a>';
        echo '</li>';
        echo '</ul>';

        // Bouton de déconnexion à droite
        echo '<ul class="navbar-nav">';
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="deconnexion.php">Déconnexion</a>';
        echo '</li>';
        echo '</ul>';
        
        echo '</div>';
        echo '</nav>';

        // Tableau des commandes
        echo "<div class='container mt-4'>";
        echo "<h2>Liste des Commandes</h2>";
        echo "<table class='table'>";
        echo "<thead class='thead-light'>";
        echo "<tr><th>ID</th><th>Nom Client</th><th>Email</th><th>Adresse</th><th>Téléphone</th><th>Date Commande</th><th>Heure Commande</th><th>Saveur</th><th>Type</th><th>Quantité</th><th>Extras</th></tr>";
        echo "</thead>";
        echo "<tbody>";

        // Boucle pour afficher chaque commande
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['nom']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['adresse']."</td>";
            echo "<td>".$row['telephone']."</td>";
            echo "<td>".$row['date_commande']."</td>";
            echo "<td>".$row['heure_commande']."</td>";
            echo "<td>".$row['saveur_glace']."</td>";
            echo "<td>".$row['type_glace']."</td>";
            echo "<td>".$row['quantite']."</td>";
            echo "<td>".$row['extras']."</td>";
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
} catch (PDOException $e) {
    echo "Erreur PDO : " . $e->getMessage(); // Affiche l'erreur PDO
}
?>
