<?php
include 'config.php'; // Inclure le fichier de configuration pour se connecter à la base de données

try {
    // Requête pour sélectionner toutes les commandes de la deuxième table
    $sql2 = "SELECT * FROM commandes_glaces2";
    $stmt2 = $pdo->query($sql2);

    // Vérifier si la requête s'est bien exécutée
    if ($stmt2 === false) {
        throw new Exception("Erreur lors de l'exécution de la requête SQL : " . print_r($pdo->errorInfo(), true));
    }

    // Début de la sortie HTML
    echo "<html>";
    echo "<head>";
    echo "<title>Liste des Commandes (Table 2)</title>";
    // Inclure Bootstrap CSS (exemple de lien CDN)
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
    echo "</head>";
    echo "<body>";
    
    // En-tête de la page
    echo '<div class="container">';
    echo '<h2>Liste des Commandes (Table 2)</h2>';
    
    // Vérifier s'il y a des commandes à afficher
    if ($stmt2->rowCount() > 0) {
        // Affichage du tableau des commandes
        echo '<table class="table">';
        echo '<thead class="thead-light">';
        echo '<tr><th>ID</th><th>Nom Produit</th><th>Prix</th><th>Email</th><th>Adresse Livraison</th><th>Méthode de Paiement</th><th>Date de Commande</th><th>Action</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['nom_produit'].'</td>';
            echo '<td>'.$row['prix'].'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>'.$row['adresse_livraison'].'</td>';
            echo '<td>'.$row['methode_paiement'].'</td>';
            echo '<td>'.$row['date_commande'].'</td>';
            echo '<td><a href="page_paiement.php?id='.$row['id'].'" class="btn btn-primary">Payer</a></td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Aucune commande trouvée.</p>';
    }

    // Fin de la sortie HTML
    echo "</div>";
    echo "</body>";
    echo "</html>";

} catch (Exception $e) {
    // Gestion des exceptions
    echo "Erreur : " . $e->getMessage();
}

// Inclure Bootstrap JavaScript (facultatif, pour les fonctionnalités comme le dropdown)
echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>';
echo '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
?>
