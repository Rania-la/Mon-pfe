<?php
// Vérifier si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Paramètres de connexion à la base de données
    $serveur = "localhost"; // ou l'adresse IP de votre serveur MySQL
    $utilisateur = "root"; // Le nom d'utilisateur de votre base de données
    $motDePasse = ""; // Le mot de passe de votre base de données
    $baseDeDonnees = "pfe"; // Le nom de votre base de données

    // Création de la connexion
    $conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
// Vérifier si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification que toutes les données du formulaire sont présentes
    if (!isset($_POST['fullName'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'])) {
        echo "Tous les champs du formulaire sont requis.";
        exit();
    }

    // Paramètres de connexion à la base de données
    $serveur = "localhost"; // ou l'adresse IP de votre serveur MySQL
    $utilisateur = "root"; // Le nom d'utilisateur de votre base de données
    $motDePasse = ""; // Le mot de passe de votre base de données
    $baseDeDonnees = "pfe"; // Le nom de votre base de données

    // Création de la connexion
    $conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Récupérer les données du formulaire d'inscription
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirmPassword) {
        echo "Les mots de passe ne correspondent pas !";
        exit(); // Arrêter le script si les mots de passe ne correspondent pas
    }

    // Vérifier si l'email existe déjà dans la base de données
    $sql_check = "SELECT id FROM users WHERE email='$email'";
    $result_check = $conn->query($sql_check);

    if ($result_check === false) {
        echo "Erreur lors de la vérification de l'email : " . $conn->error;
        exit();
    }

    if ($result_check->num_rows > 0) {
        echo "Un compte avec cet email existe déjà. Veuillez vous connecter.";
        exit(); // Arrêter le script si un compte existe déjà avec cet email
    }

    // Hashage du mot de passe pour sécurité
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête d'insertion
    $sql_insert = "INSERT INTO users (fullName, email, password) VALUES ('$fullName', '$email', '$hashedPassword')";

    if ($conn->query($sql_insert) === TRUE) {
        // Redirection vers la page d'accueil
        header("Location: redirection.html");
        exit(); // Assurez-vous que rien d'autre n'est exécuté après la redirection
    } else {
        echo "Erreur : " . $sql_insert . "<br>" . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
}

?>