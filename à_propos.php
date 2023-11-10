<?php 
session_start();
require_once './layout/header.php'; ?>


<main>
<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">À Propos</h1>
        <p class="lead text-body-secondary">Bienvenue sur notre site à propos. Découvrez qui nous sommes et ce que nous faisons.</p>
      </div>
    </div>
  </section>

  <section class="py-5 bg-body-tertiary">
    <div class="container">
      <h2 class="text-center">Notre Histoire</h2>
      <p class="text-center">Ici, vous pouvez raconter l'histoire de votre entreprise ou de votre site web. Parlez de vos valeurs, de vos objectifs et de ce qui vous rend unique.</p>
    </div>
  </section>

  <!-- Section Newsletter -->
  <section class="py-5 bg-primary text-white">
    <div class="container">
      <h2 class="text-center">Inscrivez-vous à notre Newsletter</h2>
      <p class="text-center">Restez informé de nos dernières mises à jour et offres spéciales.</p>
      <form action="newsletter_procces.php" method="POST">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Adresse e-mail" name="email" required>
              <button class="btn btn-secondary" type="submit">S'inscrire</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</main>

<?php require_once './layout/footer.php'; ?>

</body>
</html>
