<?php
require("fonctions.php");

if(isset($_POST['inscrit'])) {

    @$message = "";
    @$nom = htmlspecialchars($_POST['nom']);
    @$prenom = htmlspecialchars($_POST['prenom']);
    @$email = htmlspecialchars($_POST['email']);
    @$naissance = htmlspecialchars($_POST['naissance']);
    @$diplome = htmlspecialchars($_POST['diplome']);
    @$niveau = htmlspecialchars($_POST['niveau']);
    @$etablissement = htmlspecialchars($_POST['etablissement']);
    @$login = htmlspecialchars($_POST['log']);
    @$mdp = htmlspecialchars($_POST['mdp']);

    @$photo = $_FILES['photo'];
	@$photo_name = $_FILES['photo']['name'];
	@$photo_destination = 'photos/'. $photo_name;

	@$cv = $_FILES['cv'];
	@$cv_name = $_FILES['cv']['name'];
	@$cv_destination = 'cvs/'. $cv_name;

	 

    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['naissance']) AND !empty($_POST['diplome']) AND !empty($_POST['niveau']) AND !empty($_POST['etablissement']) AND !empty($_POST['log']) AND !empty($_POST['mdp'])) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
             switch ($niveau) {

                case '3ème':
                    $table = "etud3a";
                    $test = login_existant("etud3a",$login);
                    if( $test == true ){
                        $message = "login  déjà existe!";

                    }else{

                        if(email_existant("etud3a",$email) == false) {
                            $sizecode = 10;
                            $confirm_code = "";

                            for($i=1;$i<$sizecode;$i++){
                                $confirm_code.= mt_rand(0,9); 
                            }
							
							addCondidat("etud3a",$nom, $prenom, $email, $naissance, $diplome, $niveau, $etablissement,  $photo_destination, $cv_destination, $login,$mdp, $confirm_code);
							$msg_photo = telecharger_Fichier($photo,'photos',$msg_photo="");
							$msg_cv = telecharger_Fichier($cv,'cvs',$msg_cv="");
                            EnvoiMail ($email,$confirm_code,$table);  
                        } 
                    } break;
                

                default:
                    $table = "etud4a";
                    $test = login_existant("etud4a",$login);
                    if( $test == true){
                        $message = "login  déjà existe!";

                    }else{
                        if(email_existant("etud4a",$email) == false) {
                             $sizecode = 10;
                             $confirm_code = "";

                             for($i=1;$i<$sizecode;$i++){
                               $confirm_code.= mt_rand(0,9);
                             }
							
							addCondidat("etud4a",$nom, $prenom, $email, $naissance, $diplome, $niveau, $etablissement, $photo_destination, $cv_destination, $login, $mdp, $confirm_code);
                            $msg_photo = telecharger_Fichier($photo,'photos',$msg_photo="");
							$msg_cv = telecharger_Fichier($cv,'cvs',$msg_cv="");
							EnvoiMail ($email,$confirm_code,$table);
                            } 
                    } break;
             }

        }else{
               $message = "Votre adresse email n'est pas valide !"; }
     
    }else{
            $message = "Tous les champs doivent être complétés !"; }

}

?>



<!DOCTYPE HTML>
<html>
	<head>
		<title>Inscription</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="style/assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

				<header id="header">
				  <h1><a href="index.php">ENSA</a> - concours</h1>
					<nav id="nav">
						<ul>
							<li><a href="index.php">Accueil</a></li>
						    <li><a href="authentification.php" class="button">Se connecter</a></li>
						</ul>
					</nav>
				</header>

		
				<section id="main" class="container medium">
					<header>
						<h2>Inscription</h2>
						<p>Entrez vos informations pour participer au concours.</p>
					</header>
					<div class="box">

					<?php if (!empty($message)) { echo '<p style="color:red;">'.$message.'</p>'; } ?>

						<form method="post" action=""  enctype="multipart/form-data">
							<div class="row gtr-50 gtr-uniform">

								<div class="col-6 col-12-mobilep">
									<input type="text" name="nom"  value="" placeholder="Nom" />
								</div>

								<div class="col-6 col-12-mobilep">
									<input type="text" name="prenom" value="" placeholder="Prenom" />
								</div>

								<div class="col-6 col-12-mobilep">
									<input type="email" name="email"  value="" placeholder="Email" />
								</div>

								<div class="col-6 col-12-mobilep">
									<input type="text" name="naissance"  value="" placeholder="Date de naissance" />
								</div>

								<div class="col-12">
									<input type="text" name="etablissement"  value="" placeholder="Établissement d'origine" />
								</div>

								<div class="col-6 col-12-mobilep">
									<select  name="diplome" >
										<option value="" selected >Votre diplome</option>         
										<option value="bac+2" >Bac+2</option> 
										<option value="bac+3" >Bac+3</option>
									</select>  
								</div>

								<div class="col-6 col-12-mobilep">
									<select  name="niveau" >
										<option value="" selected >Votre niveau</option>         
										<option value="3ème" >3ème</option> 
										<option value="4ème" >4ème</option>
									</select> 
								</div>
							
								<div class="col-6 col-12-mobilep">
							     	<input type="text" name="log"  value="" placeholder="Login" />
								</div>

								<div class="col-6 col-12-mobilep">
							     	<input type="password" name="mdp"  value="" placeholder="Mot de passe" />
								</div>
							
                                <div class="col-6 col-12-mobilep">
								    <label for="photo">Ajouter votre photo d'identité :</label>
									<input type="file" name="photo" />
									<?php if(!empty($msg_photo)) echo $msg_photo; ?>
								</div> 
								
								<div class="col-6 col-12-mobilep">
								    <label for="cv">Ajouter votre CV:</label>
									<input type="file" name="cv" />
									<?php if(!empty($msg_cv)) echo $msg_cv; ?>
								</div>

								<div class="col-12">
									<ul class="actions special">
										<li><input type="submit" name="inscrit" value="s'inscrire"/></li>
										<li><input type="reset"  name="annuler" value="Annuler" /></li>
									</ul>
								</div>
								
							</div>
						</form>
					</div>
				</section>

		
		
		<footer id="footer">
				<ul class="copyright">
				    <li><img src="style/images/Universite_Cadi_Ayyad.png" alt="ENSA-M" width="100" height="90"></li>
					<li>&copy; 2023 ENSA</li><li>Ecole Nationale des Sciences Appliquées de Marrakech .</li>
				</ul>	
		</footer>

		
   </div>
</body>
</html>




