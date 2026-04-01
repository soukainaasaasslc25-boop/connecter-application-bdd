<?php 
require_once 'functions.php'; 

$mot_cle = $_GET['q'] ?? '';

if (!empty($mot_cle)) {
    $liste_recettes = searchRecipes($pdo, $mot_cle);
} elseif (!empty($_GET['cat'])) {
    $liste_recettes = filterByCategory($pdo, $_GET['cat']);
} elseif (!empty($_GET['sort'])) {
    $liste_recettes = sortRecipes($pdo, $_GET['sort']);
} else {
    $liste_recettes = obtenirRecettes($pdo, $mot_cle);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue de Recettes - GoldenFork</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>Catalogue de Recettes</h1>
    </header>

    <main>
        <form method="GET" class="search-form">
            <input 
                type="text" 
                name="q" 
                placeholder="Chercher une recette..." 
                value="<?= htmlspecialchars($mot_cle) ?>"
            >
            <button type="submit">Rechercher</button>

            <select name="cat">
                <option value="">-- Catégories --</option>
                <option value="Entree" <?= ($_GET['cat'] ?? '') === 'Entree' ? 'selected' : '' ?>>Entrée</option>
                <option value="Plat" <?= ($_GET['cat'] ?? '') === 'Plat' ? 'selected' : '' ?>>Plat</option>
                <option value="Dessert" <?= ($_GET['cat'] ?? '') === 'Dessert' ? 'selected' : '' ?>>Dessert</option>
            </select>

            <select name="sort">
                <option value="">-- Trier par --</option>
                <option value="temps_asc" <?= ($_GET['sort'] ?? '') === 'temps_asc' ? 'selected' : '' ?>>Temps (Plus court)</option>
                <option value="temps_desc" <?= ($_GET['sort'] ?? '') === 'temps_desc' ? 'selected' : '' ?>>Temps (Plus long)</option>
                <option value="recent" <?= ($_GET['sort'] ?? '') === 'recent' ? 'selected' : '' ?>>Plus récent</option>
            </select>

            <button type="submit">Appliquer</button>
            <a href="index.php" class="clear-link">Effacer</a>
        </form>

        <div class="grid">
            <?php foreach ($liste_recettes as $recette): ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($recette['image']) ?>" alt="<?= htmlspecialchars($recette['name']) ?>">
                    <div class="card-content">
                        <h3><?= htmlspecialchars($recette['name']) ?></h3>
                        <p><strong>Catégorie :</strong> <?= htmlspecialchars($recette['category']) ?></p>
                        <p><strong>Temps :</strong> <?= $recette['prep_time'] ?> min</p>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (empty($liste_recettes)): ?>
                <p class="no-result">Aucune recette trouvée.</p>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>