
<?php
session_start();

// Vide le panier
$_SESSION['panier'] = array();

header("Location: panier.php");
exit;
?>
