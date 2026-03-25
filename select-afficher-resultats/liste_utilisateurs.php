<?php
require 'conexion.php';

try {
    $sql = "SELECT * FROM Utilisateur";
    $stmt = $pdo->query($sql);

    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($utilisateurs as $user) {
        echo "ID : " . $user['id'] . " - Nom : " . $user['nom'] . " - Email : " . $user['email'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}


echo "<table border='1'>
<tr><th>ID</th><th>Nom</th><th>Email</th></tr>";
foreach ($utilisateurs as $user) {
    echo "<tr><td>{$user['id']}</td><td>{$user['nom']}</td><td>{$user['email']}</td></tr>";
}
echo "</table>";