<?php
session_start();
require_once './layout/header.php';

// Initialise le panier à partir de la session
$panier = isset($_SESSION['panier']) ? $_SESSION['panier'] : array();

?>

<div class="container">
    <h1>Panier</h1>

    <?php if (empty($panier)) : ?>
        <p>Votre panier est vide.</p>
    <?php else : ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($panier as $product) : ?>
                    <tr>
                        <td><?php echo $product['nom']; ?></td>
                        <td><?php echo $product['prix']; ?> €</td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form action="checkout.php" method="post">
            <button type="submit" class="btn btn-primary">Procéder au paiement</button>
        </form>

        <form action="clear_cart.php" method="post">
            <button type="submit" class="btn btn-danger">Vider le panier</button>
        </form>
    <?php endif; ?>
</div>


<?php require_once './layout/footer.php'; ?>
