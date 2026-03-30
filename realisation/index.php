<?php 

require_once 'functions.php'; 


$mot_cle = $_GET['q'] ?? '';



if (!empty($mot_cle)) {
    $liste_recettes=searchRecipes($pdo,$mot_cle);
} elseif (!empty($_GET['cat'])) {
    $liste_recettes = filterByCategory($pdo, $_GET['cat']);
} elseif (!empty($_GET['sort'])) {
    $liste_recettes = sortRecipes($pdo, $_GET['sort']);
}else{
    $liste_recettes = obtenirRecettes($pdo, $mot_cle);
}



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

    <form method="GET">
        <input type="text" name="q" placeholder="Chercher une recette..." value="<?= htmlspecialchars($mot_cle) ?>">
        <button type="submit">Rechercher</button>
        <select name="cat">
            <option value="">-- Catégories --</option>
            <option value="Entree">Entrée</option>
            <option value="Plat">Plat</option>
            <option value="Dessert">Dessert</option>
        </select>

        <select name="sort">
            <option value="">-- Trier par --</option>
            <option value="temps_asc">Temps (Plus court)</option>
            <option value="temps_desc">Temps (Plus long)</option>
            <option value="recent">Plus récent</option>
        </select>
        <button type="submit">Appliquer</button>
        <a href="index.php">Effacer</a>
    </form>

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