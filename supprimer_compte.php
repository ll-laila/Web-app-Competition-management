<?php
session_start();

require_once('fonctions.php');

if(isset($_POST['supprimer'])) {
    
   
    $supp = supprimer_condidat($_SESSION['utilisateur_table'], $_SESSION['utilisateur_login'], $_SESSION['utilisateur_pass']);

    if($supp) {
        header("Location: index.php");
    }
    

}

session_destroy();
?>

