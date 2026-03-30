<?php

require_once 'conexion.php';

function obtenirRecettes($pdo) {
    
  
       
        $stmt = $pdo->query("SELECT * FROM recipes");
  
    
        
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}