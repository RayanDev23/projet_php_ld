<?php
session_start();
require_once './layout/header.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

$userEmail = $_SESSION['user_email'];
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Tableau de bord</h1>
    <p class="lead text-center">Bienvenue, <?= $userEmail ?>!</p>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card my-4">
                <h2 class="card-header">Photo de profil</h2>
                <div class="card-body text-center">
                    <?php
                    if (isset($_SESSION['user_profile'])) {
                        $userProfile = $_SESSION['user_profile'];
                        echo '<img src="' . $userProfile . '" class="img-thumbnail" alt="Photo de profil" />';
                    } else {
                        echo '<p>Vous n\'avez pas encore de photo de profil.</p>';
                    }
                    ?>

                    <form action="upload_profile.php" method="post" enctype="multipart/form-data" class="my-4">
                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Télécharger une photo de profil</label>
                            <input type="file" class="form-control" id="profileImage" name="profileImage">
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>

            <div class="card my-4">
                <h2 class="card-header">Modifier le mot de passe</h2>
                <div class="card-body">
                    <form action="change_password.php" method="post">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Mot de passe actuel</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier le mot de passe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a href="logout.php" class="btn btn-primary d-block mx-auto">Déconnexion</a>
</div>

<?php require_once './layout/footer.php' ?>
