<?php 

require_once 'functions.php'; 



$liste_recettes = obtenirRecettes($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mini Projet Recettes</title>
    <style>
        .grid { display: flex; gap: 15px; }
        .card { border: 1px solid #ddd; padding: 10px; width: 200px; border-radius: 10px; }
        .card img { width: 100%; height: 120px; object-fit: cover; border-radius: 5px; }
    </style>
</head>
<body>

    <h1> Catalogue de Recettes</h1>

    <hr>

    <div class="grid">
        <?php foreach ($liste_recettes as $recette): ?>
            <div class="card">
                <img src="<?= $recette['image'] ?>" alt="Photo">
                <h3><?= htmlspecialchars($recette['name']) ?></h3>
                <p><b>Catégorie:</b> <?= $recette['category'] ?></p>
                <p><b>Temps:</b> <?= $recette['prep_time'] ?> min</p>
            </div>
        <?php endforeach; ?>

        <?php if(empty($liste_recettes)) echo "<p>Aucune recette trouvée.</p>"; ?>
    </div>

</body>
</html>