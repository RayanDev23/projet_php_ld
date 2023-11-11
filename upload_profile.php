<?php
session_start();
require_once 'functions/db.php';
require_once './classes/Utils.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}

// Vérifiez si un fichier a été envoyé
if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
    
    $uploadDir = 'profile_images/';

    // Générez un nom de fichier unique en fonction de l'ID de l'utilisateur
    $userEmail = $_SESSION['user_email'];
    $fileName = $userEmail . '_' . time() . '_' . $_FILES['profileImage']['name'];

    // Chemin complet du fichier de destination
    $uploadPath = $uploadDir . $fileName;

    // Déplacez le fichier téléchargé vers le répertoire de destination
    if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $uploadPath)) {
        
        $_SESSION['user_profile'] = $uploadPath;
        

        $pdo = getConnection();
        $userEmail = $_SESSION['user_email'];
        $updateQuery = "UPDATE utilisateurs SET profil_image = :profil_image WHERE email = :email";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute(['profil_image' => $uploadPath, 'email' => $userEmail]);

        // Redirigez l'utilisateur vers le tableau de bord
        Utils::redirect('dashbord.php');
        exit;
    } else {
        echo "Une erreur s'est produite lors du téléchargement de la photo de profil.";
    }
} else {
    echo "Veuillez sélectionner un fichier valide pour votre photo de profil.";
}
?>
