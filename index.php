<?php
session_start();
require_once './layout/header.php';
require_once './functions/db.php';
?>
<body>

  <main>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Album example</h1>
          <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">Promo</a>
          </p>
        </div>
      </div>
    </section>

    <div class="album py-5 bg-body-tertiary">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

          <?php
          try {
              $pdo = getConnection();

              // Sélectionnez les produits de la table produits avec une limite
              $query = "SELECT id, nom, description, prix, stock, image_sport FROM produits LIMIT :limit";
              $stmt = $pdo->prepare($query);
              $stmt->bindValue(':limit', 2, PDO::PARAM_INT);
              $stmt->execute();

              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $productId = $row['id'];
                  $productName = $row['nom'];
                  $productDescription = $row['description'];
                  $productPrice = $row['prix'];
                  $productStock = $row['stock'];
                  $productImage = $row['image_sport'];
          ?>

                  <div class="col">
                    <div class="card shadow-sm">
                      <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>">
                      <div class="card-body">
                        <h2><?php echo $productName; ?></h2>
                        <p><?php echo $productDescription; ?></p>
                        <p>Prix : <?php echo $productPrice; ?> €</p>
                        <p>En stock : <?php echo $productStock; ?> unités</p>
                        <!-- Ajoutez ici un bouton pour ajouter le produit au panier ou effectuer une autre action. -->
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

  </main>

  <div class="text-body-secondary py-5">
    <div class="container">
      <p class="float-end mb-1">
        <a href="#">Back to top</a>
      </p>
      <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
      <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.3/getting-started/introduction/">getting started guide</a>.</p>
    </div>
  </div>
</body>

<?php require_once './layout/footer.php'; ?>
