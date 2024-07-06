<?php
// Connexion à la base de données (remplacez les informations par vos propres données de connexion)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pfe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupération des catégories depuis la base de données
$sql_categories = "SELECT * FROM categories";
$result_categories = $conn->query($sql_categories);

// Vérification s'il y a des résultats de catégories
if ($result_categories->num_rows > 0) {
    while($row_category = $result_categories->fetch_assoc()) {
        $category_id = $row_category['category_id'];
        $category_name = $row_category['category_name'];

        // Affichage de chaque catégorie et de ses articles associés
        echo '<div class="col-md-4 menu-wrap">';
        echo '<div class="heading-menu text-center ftco-animate">';
        echo '<h3>' . htmlspecialchars($category_name) . '</h3>';
        echo '</div>';

        // Récupération des articles pour cette catégorie
        $sql_items = "SELECT * FROM items WHERE category_id = $category_id";
        $result_items = $conn->query($sql_items);

        // Affichage des articles de la catégorie
        if ($result_items->num_rows > 0) {
            while($row_item = $result_items->fetch_assoc()) {
                $item_name = $row_item['item_name'];
                $item_price = $row_item['item_price'];

                // Affichage de chaque article
                echo '<div class="menus d-flex ftco-animate">';
                echo '<div class="menu-img img" style="background-image: url(images/your_image.jpg);"></div>'; // Remplacez par le chemin de votre image
                echo '<div class="text">';
                echo '<div class="d-flex">';
                echo '<div class="one-half">';
                echo '<h3>' . htmlspecialchars($item_name) . '</h3>';
                echo '</div>';
                echo '<div class="one-forth">';
                echo '<span class="price">₹' . htmlspecialchars($item_price) . '</span>'; // Utilisez htmlspecialchars pour éviter les problèmes de sécurité
                echo '</div>';
                echo '</div>';
                echo '<div class="mt-2">';
                echo '<button class="btn btn-primary">';
                echo '<i class="fas fa-shopping-cart"></i> Ajouter au panier';
                echo '</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Aucun article trouvé pour cette catégorie.</p>';
        }

        echo '</div>'; // Fermeture de la div menu-wrap pour cette catégorie
    }
} else {
    echo '<p>Aucune catégorie trouvée.</p>';
}

$conn->close();
?>
