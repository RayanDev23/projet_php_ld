<?php
require_once 'functions/db.php';

function getProductById($productId) {
    try {
        $pdo = getConnection();

        // Préparez la requête pour récupérer les détails du produit par ID
        $query = "SELECT id, nom, description, prix, stock, image_sport FROM produits WHERE id = :product_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        // Récupérez le produit sous forme de tableau associatif
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retournez le produit s'il est trouvé, sinon retournez false
        return $product ? $product : false;
    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    }
}
