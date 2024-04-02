<?php
session_start();

require_once("fonctions.php");



if($_SESSION["connexion"] = "condidat"  AND  isset($_POST['pdf'])){

    $table = $_SESSION['utilisateur_table'];   
    $log = $_SESSION['utilisateur_login'];  
    $pass = $_SESSION['utilisateur_pass'];      
       
    $condidat= get_condidat($table,$log,$pass);

            @$id = $condidat['id'];
            @$nom = $condidat['nom'];
            @$prenom = $condidat['prenom'];
            @$email = $condidat['email'];
            @$naissance = $condidat['naissance'];
            @$diplome = $condidat['diplome'];
            @$niveau = $condidat['niveau'];
            @$etablissement = $condidat['etablissement'];
            @$login = $condidat['log'];
            @$mdp = $condidat['mdp'];
            @$photo = $condidat['photo'];
            @$cv = $condidat['cv']; 
           
        

$pdf = new FPDF();

    $reçu = générer_pdf($pdf,$id,$nom ,$prenom,$email,$naissance,$diplome,$niveau,$etablissement,$photo);

    if($reçu == false){

        header("Location:recap.php?erreur=erreur de chargement du pdf");

    }

}

?>
