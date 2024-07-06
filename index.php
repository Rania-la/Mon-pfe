<?php
// Connexion à la base de données (exemple)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pfe";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];
$telephone = $_POST['telephone'];
$date = $_POST['date'];
$heure = $_POST['heure'];
$saveur = $_POST['saveur'];
$type = $_POST['type'];
$quantite = $_POST['quantite'];
$extras = $_POST['extras'];
$methodePaiement = $_POST['methodePaiement'];
$numero_carte = $_POST['numero_carte']; // Assurez-vous que cette variable est correctement récupérée depuis le formulaire

// Préparation de la requête SQL d'insertion
$sql = "INSERT INTO commandes_glaces (nom, email, adresse, telephone, date_commande, heure_commande, saveur_glace, type_glace, quantite, extras, methode_paiement, numero_carte)
        VALUES ('$nom', '$email', '$adresse', '$telephone', '$date', '$heure', '$saveur', '$type', '$quantite', '$extras', '$methodePaiement', '$numero_carte')";

// Exécution de la requête
if ($conn->query($sql) === TRUE) {
    // Redirection vers la page comm.html après 2 secondes
    header("refresh:2; url=comm.html");
} else {
    echo "Erreur: " . $sql . "<br>" . $conn->error;
}

// Fermeture de la connexion à la base de données
$conn->close();
?>

