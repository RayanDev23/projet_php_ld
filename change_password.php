<?php
session_start();
require_once 'functions/db.php';
require_once 'classes/Utils.php';
require_once 'classes/ErrorMsg.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez si les champs requis existent
    $requiredFields = ['currentPassword', 'newPassword', 'confirmPassword'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            die("Le champ $field est requis.");
        }
    }

    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Vérifiez si les nouveaux mots de passe correspondent
    if ($newPassword !== $confirmPassword) {
        die("Les nouveaux mots de passe ne correspondent pas.");
    }

    try {
        $pdo = getConnection();

        // Récupérez le mot de passe actuel de la base de données
        $userEmail = $_SESSION['user_email'];
        $query = "SELECT password FROM utilisateurs WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $userEmail]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifiez si le mot de passe actuel est correct
        if ($userData && password_verify($currentPassword, $userData['password'])) {
            // Mettez à jour le mot de passe dans la base de données
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE utilisateurs SET password = :password WHERE email = :email";
            $stmtUpdate = $pdo->prepare($updateQuery);
            $stmtUpdate->execute(['password' => $hashedNewPassword, 'email' => $userEmail]);

            Utils::redirect('dashbord.php');
        } else {
            die("Le mot de passe actuel est incorrect.");
        }
    } catch (PDOException $e) {
        Utils::redirect(ErrorMsg::getMessage(ErrorMsg::LOGIN_ERROR));
        die("Une erreur est survenue lors de la modification du mot de passe. Veuillez réessayer plus tard.");
    }
} else {
    Utils::redirect('dashbord.php'); // Rediriger vers le tableau de bord si la requête n'est pas POST
}
?>
