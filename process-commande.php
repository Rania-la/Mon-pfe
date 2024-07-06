<?php
// Inclusion du fichier de configuration pour la connexion à la base de données
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $date_commande = $_POST['date'];
    $heure_commande = $_POST['heure'];
    $saveur_glace = $_POST['saveur'];
    $type_glace = $_POST['type'];
    $quantite = $_POST['quantite'];
    $extras = $_POST['extras'];
    $methode_paiement = $_POST['methodePaiement'];
    $numero_carte = $_POST['numero_carte'];
    $date_expiration = $_POST['date_expiration'];
    $cvv = $_POST['cvv'];

    // Requête d'insertion SQL sécurisée avec des paramètres préparés
    $sql = "INSERT INTO commandes_glaces (nom, email, adresse, telephone, date_commande, heure_commande, saveur_glace, type_glace, quantite, extras, methode_paiement, numero_carte, date_expiration, cvv) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $email, $adresse, $telephone, $date_commande, $heure_commande, $saveur_glace, $type_glace, $quantite, $extras, $methode_paiement, $numero_carte, $date_expiration, $cvv]);
        
        // Redirection vers une page de confirmation ou une autre page après l'enregistrement
        header("Location: comm.html");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection

    } catch (PDOException $e) {
        echo "Erreur d'insertion : " . $e->getMessage();
    }
}
?>
