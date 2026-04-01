<?php

require_once 'db.php';

function obtenirRecettes($pdo) {
    
   
    $stmt = $pdo->query("SELECT * FROM recipes");
    
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function searchRecipes($pdo,$mot_cle=''){

    if (!empty($mot_cle)) {
        $sql = "SELECT * FROM recipes WHERE name LIKE :nom";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nom' => '%' . $mot_cle . '%']);
    }else{
        echo"ocune recete trouver";
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function filterByCategory($pdo,$category){
    $stmt = $pdo->prepare("SELECT * FROM recipes WHERE category = :cat");
    $stmt->execute(['cat' => $category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function sortRecipes($pdo, $category) {
    $sql = "SELECT * FROM recipes";

  
    switch ($category) {
        case 'temps_asc':
            $sql .= " ORDER BY prep_time ASC";
            break;
        case 'temps_desc':
            $sql .= " ORDER BY prep_time DESC";
            break;
        case 'recent':
            $sql .= " ORDER BY created_at DESC";
            break;
        case 'ancien':
            $sql .= " ORDER BY created_at ASC";
            break;
        default:
   
            $sql .= " ORDER BY name ASC";
            break;
    }

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}