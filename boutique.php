<?php
session_start();
require_once './layout/header.php';
require_once './functions/db.php';
require_once './functions/displayProduct.php';

// Récupérer la catégorie sélectionnée depuis le formulaire
$categoryFilter = isset($_POST['categorie']) ? $_POST['categorie'] : 'toutes';
?>

<body>
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Boutique</h1>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!-- Menu déroulant pour les catégories -->
                    <form method="post" action="boutique.php">
                        <div class="mb-3">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <select class="form-select" id="categorie" name="categorie">
                                <option value="toutes">Toutes les catégories</option>
                                <!-- Vous pouvez générer les options à partir de votre base de données ici -->
                                <?php
                                try {
                                    $pdo = getConnection();
                                    $query = "SELECT id, nom FROM categories";
                                    $stmt = $pdo->query($query);

                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $categoryId = $row['id'];
                                        $categoryName = $row['nom'];
                                        echo '<option value="' . $categoryId . '" ' . ($categoryId == $categoryFilter ? 'selected' : '') . '>' . $categoryName . '</option>';
                                    }
                                } catch (PDOException $e) {
                                    echo 'Erreur : ' . $e->getMessage();
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                    </form>
                </div>
                <div class="col-md-9">
                    <!-- Liste des produits -->
                    <div class="row row-cols-1 row-cols-md-3 g-3">
                        <?php
                        try {
                            $pdo = getConnection();

                            // Récupérez la catégorie sélectionnée depuis le formulaire
                            $categoryFilter = isset($_POST['categorie']) ? $_POST['categorie'] : 'toutes';

                            // Appeler la fonction pour afficher les produits en fonction de la catégorie
                            $products = displayProductsByCategory($pdo, $categoryFilter);

                            foreach ($products as $product) {
                                // Utilisez les variables du tableau $product pour afficher les informations du produit
                        ?>
                                <div class="col">
                                    <div class="card shadow-sm">
                                        <img src="<?php echo $product['image_sport']; ?>" alt="<?php echo $product['nom']; ?>">
                                        <div class="card-body">
                                            <h2><?php echo $product['nom']; ?></h2>
                                            <p><?php echo $product['description']; ?></p>
                                            <p>Prix : <?php echo $product['prix']; ?> €</p>
                                            <form action="add_to_cart.php" method="post">
                                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                                <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } catch (PDOException $e) {
                            echo 'Erreur : ' . $e->getMessage();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once './layout/footer.php'; ?>
</body>
