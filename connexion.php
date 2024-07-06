<?php
// Vérifier si la méthode de requête est POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification que toutes les données du formulaire sont présentes
    if (!isset($_POST['email'], $_POST['password'])) {
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

    // Échapper les entrées utilisateur pour éviter les injections SQL
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Requête pour récupérer le mot de passe hashé associé à cet email
    $sql = "SELECT id, fullName, password FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
        exit();
    }

    if ($result->num_rows == 1) {
        // Récupérer la ligne de résultat
        $row = $result->fetch_assoc();

        // Vérifier le mot de passe hashé
        if (password_verify($password, $row['password'])) {
            // Démarrer la session PHP
            session_start();

            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['fullName'];

            // Redirection vers une page sécurisée (par exemple, dashboard.php)
            header("Location: redirection.html");
            exit();
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    } else {
        echo "Email ou mot de passe incorrect.";
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
