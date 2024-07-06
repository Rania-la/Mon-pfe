<?php
session_start();
include 'config.php';

$error = ''; // Initialiser la variable d'erreur

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et valider les données du formulaire
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // Requête SQL pour sélectionner l'administrateur par nom d'utilisateur
    $sql = "SELECT * FROM admins WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'administrateur existe et vérifier le mot de passe
    if ($admin && password_verify($password, $admin['password'])) {
        // Authentification réussie, enregistrer l'ID de l'administrateur en session
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin_dashboard.php"); // Rediriger vers le tableau de bord admin
        exit;
    } else {
        // Nom d'utilisateur ou mot de passe incorrect
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .login-container button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion Admin</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <br>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <br>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
