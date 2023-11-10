<?php
session_start();
require_once './functions/getProduct.php'; 

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    $productDetails = getProductById($productId);

    

    if ($productDetails) {
        // Ajoutez le produit au panier
        $_SESSION['panier'][] = $productDetails;

        // Redirigez l'utilisateur vers la page boutique ou une autre page après l'ajout au panier
        header('Location: panier.php');
        exit;
    } else {
        // Le produit avec l'ID spécifié n'existe pas
        header('Location: erreur.php?message=Produit introuvable');
        exit;
    }
} else {
    // Redirigez l'utilisateur vers une page d'erreur si le formulaire n'est pas soumis correctement
    header('Location: erreur.php?message=Erreur de soumission du formulaire');
    exit;
}
?>
