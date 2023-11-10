<?php
session_start(); 
require_once './layout/header.php';

?>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="mt-5">Connexion</h2>
                <form method="post" action="login_procces.php">
                    <div class="form-group">
                        <label for="email">Adresse e-mail :</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe :</label>
                        <input type="password" class="form-control" name="password" id="password" >
                    </div>
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </form>
            </div>
        </div>
    </div>


    <?php require_once './layout/footer.php'?>
