<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('D8.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .confirmation-page {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container confirmation-page mt-5">
        <h1 class="text-center">Confirmation de commande</h1>
        <br>
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            echo "<div class='alert alert-success' role='alert'>
                    Votre commande a été traitée avec succès. Merci pour votre achat !
                  </div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>
                    Une erreur s'est produite lors du traitement de votre commande. Veuillez réessayer.
                  </div>";
        }
        ?>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Retour à la page d'accueil</a>
        </div>
    </div>
</body>
</html>
