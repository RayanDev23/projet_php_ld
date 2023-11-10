<?php

require_once 'classes/Utils.php';
require_once 'classes/ErrorMsg.php';
require_once 'functions/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Utils::redirect('login.php'); 
}

// Vérifiez si les champs requis existent
$requiredFields = ['email', 'password'];
foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        die("Le champ $field est requis.");
    }
}

$email = $_POST['email'];
$password = $_POST['password'];

try {
    $pdo = getConnection();

    // Recherche de l'utilisateur dans la base de données en fonction de l'adresse e-mail
    $query = "SELECT * FROM utilisateurs WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie, redirection vers la page du tableau de bord
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_profile'] = $user['profil_image'];
        Utils::redirect('dashbord.php');
    } else {
        // Identifiants incorrects, redirigez vers la page de connexion avec un message d'erreur
        Utils::redirect('login.php?error=' . ErrorMsg::getMessage(ErrorMsg::USER_NOT_FOUND)) ;
    }
} catch (PDOException $e) { 
    Utils::redirect(ErrorMsg::getMessage(ErrorMsg::LOGIN_ERROR)); 
    die("Une erreur est survenue lors de la connexion. Veuillez réessayer plus tard.");
}
