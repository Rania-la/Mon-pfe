<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    
    // Manipulation de l'image si téléchargée
    $image = null;
    if ($_FILES["image"]["size"] > 0) {
        $target_dir = "images/"; // Répertoire où stocker les images
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image = $target_file;
    }
    
    // Exemple simple : affichage des données ajoutées
    echo "<h2>Article ajouté :</h2>";
    echo "<p>Nom : $name</p>";
    echo "<p>Description : $description</p>";
    echo "<p>Prix : $price</p>";
    if ($image) {
        echo "<p>Image : <img src='$image' width='200'></p>";
    }
    
    // Ici, vous devrez insérer ces données dans votre base de données ou les stocker selon vos besoins
}
?>
