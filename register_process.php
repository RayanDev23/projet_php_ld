<?php

require_once 'classes/Utils.php';
require_once 'classes/ErrorMsg.php';
require_once 'functions/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Utils::redirect('Signup.php');
}

// Vérifiez si les champs requis existes
$requiredFields = ['name', 'first_name', 'email', 'password', 'confirm_password'];
foreach ($requiredFields as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        die("Le champ $field est requis.");
    }
}

// Valider l'adresse e-mail
$email = $_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("L'adresse e-mail n'est pas valide.");
}

// Assurez-vous que les mots de passe correspondent
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];
if ($password !== $confirmPassword) {
    die("Les mots de passe ne correspondent pas.");
}

try {
    $pdo = getConnection();

    // Vérifier si l'adresse e-mail existe déjà dans la base de données
    $checkQuery = "SELECT COUNT(*) FROM utilisateurs WHERE email = :email";
    $stmtCheck = $pdo->prepare($checkQuery);
    $stmtCheck->execute(['email' => $email]);
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
        die("L'adresse e-mail est déjà utilisée.");
    } else {
        // Code pour traiter l inscription 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO utilisateurs (`name`, `first_name`, `email`, `password`) VALUES (:name, :first_name, :email, :hashedPassword)";
        $stmtInsert = $pdo->prepare($query);
        $stmtInsert->execute([
            'name' => $_POST['name'],
            'first_name' => $_POST['first_name'],
            'email' => $email,
            'hashedPassword' => $hashedPassword
        ]);

        Utils::redirect('index.php');
    }
} catch (PDOException $e) {
    Utils::redirect(ErrorMsg::getMessage(ErrorMsg::SUBSCRIBE_ERROR)) . $e->getMessage();
    die("Une erreur est survenue lors de l'inscription. Veuillez réessayer plus tard.");
}
