<?php
include 'config.php';

$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ice_cream_flavor VARCHAR(255) NOT NULL,
    ice_cream_type VARCHAR(255) NOT NULL,
    quantity INT NOT NULL
)";

if ($pdo->exec($sql) !== false) {
    echo "La table orders a été créée avec succès.";
} else {
    echo "Erreur lors de la création de la table orders : " . print_r($pdo->errorInfo(), true);
}
?>
