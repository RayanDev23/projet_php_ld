<!-- product_card.php -->

<div class="col">
    <div class="card shadow-sm">
        <img src="<?php echo $product['image_sport']; ?>" alt="<?php echo $product['nom']; ?>">
        <div class="card-body">
            <h2><?php echo $product['nom']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <p>Prix : <?php echo $product['prix']; ?> €</p>
            <p>En stock : <?php echo $product['stock']; ?> unités</p>
            
            <!-- Bouton pour ajouter le produit au panier -->
            <form action="panier.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <button type="submit" class="btn btn-primary">Ajouter au panier</button>
            </form>
        </div>
    </div>
</div>


