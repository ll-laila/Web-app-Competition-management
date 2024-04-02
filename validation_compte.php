<?php
require_once("fonctions.php");

if(isset($_GET['confirm_code']) AND isset($_GET['table']) AND !empty($_GET['confirm_code']) AND !empty($_GET['table'])) {

   $confirm_code = $_GET['confirm_code'];
   $table = $_GET['table'];

   $req = connect()->prepare("SELECT * FROM $table WHERE  confirm_code = ?");
   $req->execute(array($confirm_code));

   $condidat_exist = $req->rowCount();

   if($condidat_exist == 1) {
      $condidat = $req->fetch();
        if($condidat['confirme'] == 0) {                //l'attribut confirme a pour valeur par défaut 0 
            $modifier_cond = connect()->query("UPDATE $table SET confirme = 1 WHERE confirm_code = '$confirm_code'");
            
              header("Location:authentification.php?mesg=Votre compte a bien été confirmé !");
                   
        }else{
              header("Location:authentification.php?mesg=Votre compte a déjà été confirmé !");     
        }
     
   
    }else{
        header("Location: index.php");
   }
} 
?>