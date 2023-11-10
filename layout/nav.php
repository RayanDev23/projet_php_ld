<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a href="./index.php">
      <img class="image-fluid" id="logo" src="./assets/img/logo_muscu.png"/>
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-around" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./boutique.php">Boutique</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./à_propos.php">À propos</a>
        </li>
        <?php if (isset($_SESSION['user_profile'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="./dashbord.php">
              <img src="<?php echo $_SESSION['user_profile']; ?>" alt="Photo de profil" class="profile-image" style="border-radius: 50%; width: 32px; height: 32px;">
            </a>
          </li>
        <?php endif; ?>

        <?php
        // Vérifiez si l'utilisateur est connecté
        if (isset($_SESSION['user_email'])) {
          // Affichez le bouton de déconnexion dans la nav si l'utilisateur est connecté
          echo '<li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>';
        } else {
          // Si l'utilisateur n'est pas connecté, affichez les liens d'inscription et de connexion
          echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
          echo '<li class="nav-item"><a class="nav-link" href="Signup.php">Sign up</a></li>';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>



