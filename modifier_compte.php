<?php
session_start();
require("fonctions.php");

if (!isset($_SESSION["connexion"]) || $_SESSION["connexion"] !== "condidat") {
    header('Location: authentification.php');
    exit();
}


$table = $_SESSION['utilisateur_table'];
$log = $_SESSION['utilisateur_login'];
$pass = $_SESSION['utilisateur_pass'];    

$condidat = get_condidat($table, $log, $pass);



    if (isset($_POST['modifier'])) {

        $id = $_SESSION['utilisateur_id'];
        $table = $_SESSION['utilisateur_table'];
        

        @$new_nom = $_POST['_nom'];
        @$new_prenom = $_POST['_prenom'];
        @$new_email = $_POST['_email'];
        @$new_naissance = $_POST['_naissance'];
        @$new_diplome = $_POST['_diplome'];
        @$new_etablissement = $_POST['_etablissement'];
        @$new_login = $_POST['_log'];
        @$new_mdp = $_POST['_mdp'];

        $_SESSION['utilisateur_login'] = $new_login ;
        $_SESSION['utilisateur_pass'] = $new_mdp ;    


        $new_photo = $condidat['photo'];
        if (isset($_FILES['_photo']) && $_FILES['_photo']['error'] == UPLOAD_ERR_OK) {
            @$photo_tmp = $_FILES['_photo']['tmp_name'];
            $new_photo = 'photos/'.$_FILES['_photo']['name'];
            move_uploaded_file($photo_tmp,$new_photo);
        }

        $new_cv = $condidat['cv'];
        if (isset($_FILES['_cv']) && $_FILES['_cv']['error'] == UPLOAD_ERR_OK) {
            @$cv_tmp = $_FILES['_cv']['tmp_name'];
            $new_cv = 'cvs/'.$_FILES['_cv']['name'];
            move_uploaded_file($cv_tmp,$new_cv);
        }


        $modifier = modifier_condidat($table, $id, $new_nom, $new_prenom, $new_email, $new_naissance, $new_diplome, $new_etablissement, $new_photo,$new_cv, $new_login, $new_mdp);

        
        if ($modifier === true) {
            
            $condidat_mod= get_condidat($table,$new_login,$new_mdp);
            $_SESSION['condidat_mod'] =  $condidat_mod;
            header("Location:recap.php?message=les modifications sont effectuées avec succès.");
            exit();
            
        } else {
            
            header("Location:recap.php?message=les modifications sont échoués !");
            exit();
        }
    }

    if (isset($_POST["annuler" ])) {

        header("Location:recap.php");

    }
    ?>



<!DOCTYPE HTML>
<html>
	<head>
		<title>Modification des informations personnelles</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="style/assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

				<header id="header">
				  <h1><a href="recap.php"><img src="style/images/retour_.gif" alt="ENSA-M" width="40" height="40"></a></h1>
					<nav id="nav">
						<ul>
							<li><a href="index.php">Accueil</a>
						</ul>
					</nav>
				</header>

	
		 <section id="main" class="container">
			<header>
				<h2>Modification des informations personnelles</h2>
			</header>

			<section class="box">
			  <h3>Votre informations</h3>	
				<div class="table-wrapper">
                   <form action="" method="POST" enctype="multipart/form-data">
                      <table>
                            <tr>
                                <td>Nom:</td>
                                <td><input type="text" name="_nom" value ='<?php if(isset($condidat['nom'])) print $condidat['nom']; ?>' /> </td>
                            </tr>

                            <tr>                                                                               
                                <td> Prénom:</td>
                                <td> <input type="text" name="_prenom" value ='<?php if(isset($condidat['prenom'])) print $condidat['prenom']; ?>'/> </td>
                            </tr>

                            <tr>
                                <td> email:</td>
                                <td> <input type="email" name="_email" value ='<?php if(isset($condidat['email'])) print $condidat['email']; ?>'/> </td>
                            </tr>

                            <tr>
                                <td> date de naissance:</td>
                                <td> <input type="text" name="_naissance" value ='<?php if(isset($condidat['naissance'])) print $condidat['naissance']; ?>'/> </td>
                            </tr>

                            <tr>
                                <td> Diplôme:</td>
                                <td> <select  name="_diplome" >
                                    <option value='' selected >Choisir une option</option>         
                                    <option value="bac+2" <?php if(isset($condidat['diplome'] ) && $condidat['diplome'] == "bac+2") print "selected"; ?> >Bac+2</option> 
                                    <option value="bac+3" <?php if(isset($condidat['diplome'] ) && $condidat['diplome'] == "bac+3") print "selected"; ?>>Bac+3</option>
                                    </select>  
                                </td>
                            </tr>
                        
                            <tr>
                                <td>Établissement d'origine :</td>
                                <td> <input type="text" name="_etablissement" value ='<?php if(isset($condidat['etablissement'])) print $condidat['etablissement']; ?>'/></td>
                            </tr>

                            <tr>
                                <td>photo:</td>
                                 <?php  $photo_dest = explode('/',$condidat['photo']);
                                       $_photo = $photo_dest[1];   
                                 ?>
                                <td><input type="file" name="_photo" value ='<?php if(isset($_photo)) print $_photo; ?>'/></td>
                            </tr>

                            <tr>
                                <td>CV:</td>
                                <?php  $cv_dest = explode('/',$condidat['cv']);
                                       $_cv = $cv_dest[1];  
                                ?>
                                <td><input type="file" name="_cv" value ='<?php if(isset($_cv)) print $_cv; ?>'/></td>
                            </tr>

                            <tr>
                                <td>login :</td>
                                <td> <input type="text" name="_log" value ='<?php if(isset($condidat['log'])) print $condidat['log']; ?>'/></td>
                            </tr>

                            <tr>
                                <td>mot de passe:</td>
                                <td> <input type="password" name="_mdp" value ='<?php if(isset($condidat['mdp'])) print $condidat['mdp']; ?>'/></td>
                            </tr>
                            
                        </table>

                            <div class="col-12">
                                <ul class="actions">
                                  <li><input type="submit" name="modifier" value="Modifier"/></li>
                                  <li><a href='recap.php' class='button'>Annuler</a></li>
                                </ul>
                            </div>
                    </form> 	
						
			</section>
		</section>
	  </div>
       

      <footer id="footer">
				<ul class="copyright">
				    <li><img src="style/mages/Universite_Cadi_Ayyad.png" alt="ENSA-M" width="100" height="90"></li>
					<li>&copy; 2023 ENSA</li><li>Ecole Nationale des Sciences Appliquées de Marrakech .</li>
				</ul>	
	  </footer>

	
</body>
</html> 