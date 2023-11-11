<?php
require_once './classes/Utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    if (isset($_POST['email'])) {
        
        $email = $_POST['email'];

        
        echo "Merci de vous être inscrit à notre newsletter avec l'adresse e-mail : $email";
    } else {
        echo "L'adresse e-mail est manquante.";
    }
} else {
    //Je redirige vers la page à propos si la demande n'est pas de type POST
    Utils::redirect('à_propos.php');
    exit;
}
