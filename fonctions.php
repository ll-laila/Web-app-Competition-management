<?php
require('fpdf/fpdf.php'); 


// la connexion au BDD
function connect(){

    $hostname = "localhost";
    $database = "concours";
    $username = "root";
    $password = "";
    $dsn='mysql:host='.$hostname.';dbname='.$database;
      try{
          $connexion=new PDO($dsn,$username,$password);
          $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          return $connexion;
      }
      catch(PDOException $e){
      printf("Échec de la connexion : %s\n", $e->getMessage());
      exit();
      }
 }





// chargement du cv / photo
function telecharger_Fichier($fichier,$dossier,$notif="") {
        
        $chemin = $dossier ."/". $fichier['name'];

        if (!move_uploaded_file($fichier['tmp_name'], $chemin)) {
                $notif.="Erreur de chargement ! <br>";
        }else{
                $notif.="Fichier chargé avec succés.";
        }

    return $notif;
}
 




// verification de l'existance d'un compte par login
 function login_existant($nom_table,$login){

        $tab = connect()->query("SELECT * FROM $nom_table where log = '$login' ");
        $resultat=$tab->fetchAll();
        $nombre = count($resultat);
        if( $nombre == 0 )  return false;
        else return true;   
}





// verification de l'existance d'un compte par email
function email_existant($nom_table,$email){

    $tab = connect()->query("SELECT * FROM $nom_table where  email = '$email' ");
    $resultat=$tab->fetchAll();
    $nombre = count($resultat);
    if( $nombre == 0 )  return false;
    else return true;   
}





// ajouter un condidats
function addCondidat($nom_table,$nom, $prenom, $email, $naissance, $diplome, $niveau, $etablissement, $photo, $cv, $login, $mdp,$confirm_code){

    $sql = "INSERT INTO $nom_table (nom, prenom, email, naissance, diplome, niveau, etablissement, photo, cv, log, mdp,confirm_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    $inserer = connect()->prepare($sql);
    $valeurs = array($nom, $prenom, $email, $naissance, $diplome, $niveau, $etablissement, $photo, $cv, $login, $mdp ,$confirm_code);
    $inserer->execute($valeurs);

}





// fonction pour l'authentifaction de condidats
function get_condidat($nom_tabe,$login,$pass)
{   
        $sql_1="SELECT * FROM $nom_tabe  WHERE log='$login' AND mdp='$pass'";
        $verifier_1 = connect()->prepare($sql_1);
        $verifier_1->execute();
        $resultat = $verifier_1->fetch(PDO::FETCH_ASSOC);
        return $resultat;
}



 

//récupération  les informations des condidats
function afficher($nom_table){

        $req="SELECT*from $nom_table ";
        $sel=connect()->query($req);
        $resultat=$sel->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
}




//supprimer comptes n'ont pas confirmé
function supprimerNonConfirmes($nom_table) {
    $sql = "DELETE FROM $nom_table WHERE confirme = 0";
    $supprimer = connect()->prepare($sql);
    $supprimer->execute();

    if ($supprimer->rowCount() > 0) {
        return true; // Suppression réussie
    } else {
        return false; // Aucun enregistrement supprimé
    }
}





//suppression d'un compte
function supprimer_condidat($nom_table,$login,$pass){
 
        $sql = "DELETE  FROM $nom_table WHERE log='$login' AND mdp='$pass'"; 
        $delete = connect()->prepare($sql);
        $resultat = $delete ->execute();

    return (bool)$resultat;
}







//modification des infos personnelles
function modifier_condidat($nom_table,$id,$nom, $prenom, $email, $naissance, $diplome,$etablissement, $photo, $cv,$login,$mdp){

    $sql = "UPDATE $nom_table SET nom='$nom', prenom='$prenom', email='$email',  naissance='$naissance', diplome='$diplome',etablissement='$etablissement',photo=' $photo',cv='$cv',log='$login',mdp='$mdp' WHERE id='$id'";
    $modifier = connect()->query($sql);

    if($modifier)   return true;
    else     return false;

}



//envoyer un email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function EnvoiMail ($email,$confirm_code,$table){

    require('phpmailer/src/Exception.php');
    require('phpmailer/src/PHPMailer.php');
    require('phpmailer/src/SMTP.php');

       $mail=new PHPMailer(true);
  
       $mail->isSMTP();
       $mail->Host= 'smtp.gmail.com';
       $mail->SMTPAuth= true;
       $mail->Username= 'majdizeinab1@gmail.com';
       $mail->Password= 'lfrdpgixkshyepmp';
       $mail->SMTPSecure= 'ssl';
       $mail->Port=465;
       $mail->setFrom('majdizeinab1@gmail.com'); 
       $mail->addAddress($email);
       $mail->isHTML(true);
       $message = "Pour activer votre compte, cliquez sur l'URL suivante :\n  http://localhost/PROJET_CONCOURS/validation_compte.php?table=".$table."&confirm_code=".$confirm_code."\n\nCordialement,\nL'équipe du concours des passerelles de génie informatique à l'ENSA Marrakech.";
       $mail->Body=$message;
       $mail->Subject="Confirmation d'inscription";
       if($mail->send()) return true;
       return false ;

}






/*
//envoyer un email
function EnvoiMail ($email,$confirm_code,$table){

  $destinataire = $email;
  $sujet = "Confirmation d'inscription";

  $message = "Pour activer votre compte, cliquez sur l'URL suivante:\n http://localhost/PROJET_CONCOURS/validation_compte.php?table=".$table."&confirm_code=".$confirm_code."\n\nCordialement,\nL'équipe du concours des passerelles de génie informatique à l'ENSA Marrakech.";                                                                                                                                                                                                   
  $entete = "Centent-Type: text/plain; charset=utf-8\r\n";                                                                                         
  $entete.= "From: etudiant@domaine.com\r\n";     

  if( mail ($destinataire, $sujet, $message, $entete))  return true;
  else  return false;

 } 
*/









//générer un pdf
function générer_pdf($pdf,$id,$nom ,$prenom,$email,$naissance,$diplome,$niveau,$etablissement,$photo){
        
            $pdf->AddPage();

            $pdf->Image('fpdf/Universite_Cadi_Ayyad.png', 10, 10, 25, 30);
            $pdf->Image('fpdf/ensa-marrakech-1.png', $pdf->GetPageWidth() - 55, 7, 40, 40);
            
            $pdf->SetFont('Times', 'B', 25);
            $pdf->Cell(0, 98, iconv('UTF-8', 'ISO-8859-1//TRANSLIT','Reçu d\'inscription au concours'), 0, 1, 'C');
            $pdf->Line(10, 78, $pdf->GetPageWidth() - 8, 78);
            
            $photo_dest = explode('/',$photo); 
            $_photo = $photo_dest[1];  
            
            $pdf->Image('photos/'.$_photo, 160, 84, 25, 30);
        
            $pdf->SetFont('Times', 'B', 16);
            $pdf->setX(40);
            $pdf->Cell(90, -20, iconv('UTF-8', 'ISO-8859-1//TRANSLIT','Numéro du candidat :'), 0, 0, 'L', false);
            $pdf->setX(120);
            $pdf->SetFont('Times', '', 14);
            $pdf->Cell(40, -20, $id, 0, 1, 'L', false);

            $pdf->SetFont('Times', 'B', 16);
            $pdf->setX(40);
            $pdf->Cell(90, 40, 'Nom :', 0, 0, 'L', false);
            $pdf->setX(120);
            $pdf->SetFont('Times', '', 14);
            $pdf->Cell(40, 40, iconv('UTF-8', 'ISO-8859-1//TRANSLIT',$nom), 0, 1, 'L', false);

            $pdf->SetFont('Times', 'B', 16);
            $pdf->setX(40);
            $pdf->Cell(90, -20, iconv('UTF-8', 'ISO-8859-1//TRANSLIT','Prénom :'), 0, 0, 'L', false);
            $pdf->setX(120);
            $pdf->SetFont('Times', '', 14);
            $pdf->Cell(40, -20, iconv('UTF-8', 'ISO-8859-1//TRANSLIT',$prenom), 0, 1, 'L', false);

            $pdf->SetFont('Times', 'B', 16);
            $pdf->setX(40);
            $pdf->Cell(90, 40, 'Email :', 0, 0, 'L', false);
            $pdf->setX(120);
            $pdf->SetFont('Times', '', 14);
            $pdf->Cell(40, 40, iconv('UTF-8', 'ISO-8859-1//TRANSLIT',$email), 0, 1, 'L', false);

            $pdf->SetFont('Times', 'B', 16);
            $pdf->setX(40);
            $pdf->Cell(90, -20, 'Date de naissance :', 0, 0, 'L', false);
            $pdf->setX(120);
            $pdf->SetFont('Times', '', 14);
            $pdf->Cell(40, -20, $naissance, 0, 1, 'L', false);

            $pdf->SetFont('Times', 'B', 16);
            $pdf->setX(40);
            $pdf->Cell(90, 40, 'Diplome :', 0, 0, 'L', false);
            $pdf->setX(120);
            $pdf->SetFont('Times', '', 14);
            $pdf->Cell(40, 40, $diplome, 0, 1, 'L', false);

            $pdf->SetFont('Times', 'B', 16);
            $pdf->setX(40);
            $pdf->Cell(90, -20, 'Niveau :', 0, 0, 'L', false);
            $pdf->setX(120);
            $pdf->SetFont('Times', '', 14);
            $pdf->Cell(40, -20, iconv('UTF-8', 'ISO-8859-1//TRANSLIT',$niveau), 0, 1, 'L', false);

            $pdf->SetFont('Times', 'B', 16);
            $pdf->setX(40);
            $pdf->Cell(90, 40, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', "Établissement d'origine :"), 0, 0, 'L', false);
            $pdf->setX(120);
            $pdf->SetFont('Times', '', 14);
            $pdf->Cell(40, 40,iconv('UTF-8', 'ISO-8859-1//TRANSLIT',$etablissement), 0, 1, 'L', false);

            $pdf->SetFont('Times', 'B', 16);
            $pdf->setX(40);
            $pdf->Cell(90, -20, "Inscrit au concours du :", 0, 0, 'L', false);
            $pdf->setX(120);
            $pdf->SetFont('Times', '', 14);
            $pdf->Cell(40, -20, iconv('UTF-8', 'ISO-8859-1//TRANSLIT',$niveau), 0, 1, 'L', false);

            $pdf->Line(10, 200, $pdf->GetPageWidth() - 10, 200);

            $pdf->SetFont('Times','I',12);
            $pdf->SetXY(10, 230);
            $pdf->Cell(0,9,'Merci de votre inscription et bonne chance pour le concours .',0,1,'C');

            $pdf->SetXY(170, 266);
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(30, 10, date("d/m/Y"), 0, 0, 'R'); 

            $pdf->Output();

            if ($pdf->Output()) {
                return true;
            } else {
                return false;
            }
}





?> 