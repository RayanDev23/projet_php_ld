<?php


function displayProductsByCategory($pdo, $categoryId) {
    $query = "SELECT id, nom, description, prix, stock, image_sport FROM produits WHERE id_categorie = :category_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();

    $products = array(); // Initialisez un tableau pour stocker les produits

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $product = array(
            'id' => $row['id'],
            'nom' => $row['nom'],
            'description' => $row['description'],
            'prix' => $row['prix'],
            'stock' => $row['stock'],
            'image_sport' => $row['image_sport']
        );

        $products[] = $product; // Ajoutez le produit au tableau
    }

    return $products;
}

