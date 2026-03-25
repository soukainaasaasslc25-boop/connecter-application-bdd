<?php
require 'conexion.php';

try {
    $stmt = $pdo->prepare("INSERT INTO Utilisateur (nom, email) VALUES (:nom, :email)");
    $stmt->execute([
        'nom' => 'Charlie',
        'email' => 'charlie@test.com'
    ]);
    echo "Utilisateur ajouté avec succès.";
    echo "<br>.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
$stmt = $pdo->prepare("UPDATE Utilisateur SET email = :email WHERE id = :id");
$stmt->execute([
    'email' => 'charlie.new@test.com',
    'id' => 3
]);
echo "Utilisateur mis à jour.";
echo "<br>.";
$stmt = $pdo->prepare("DELETE FROM Utilisateur WHERE id = :id");
$stmt->execute(['id' => 3]);
echo "Utilisateur supprimé.";
echo $stmt->rowCount() . " ligne(s) affectée(s).";
