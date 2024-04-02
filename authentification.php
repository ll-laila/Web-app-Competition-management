<?php
session_start();

require_once("fonctions.php");



if (isset($_POST['submit'])){
   
    $message = "";
    $login = htmlspecialchars($_POST['login']);
    $mdp = htmlspecialchars($_POST['mdp']);
    
    
    if ($login == 'admin' && $mdp == 'admin123') {

            $_SESSION["connexion"]="admin";
            header("Location: administration.php");
            exit;
    }
    
    else{ 
        
        $resultat_etud3a = get_condidat('etud3a',$login,$mdp);
        $resultat_etud4a = get_condidat('etud4a',$login,$mdp);

    
            if ($resultat_etud3a) {
				if($resultat_etud3a['confirme'] == 1){

					$_SESSION["connexion"]="condidat";
			
					$_SESSION['utilisateur_table'] = 'etud3a';
					$_SESSION['utilisateur_id'] = $resultat_etud3a['id'];
					$_SESSION['utilisateur_login'] = $resultat_etud3a['log'];
					$_SESSION['utilisateur_pass'] = $resultat_etud3a['mdp'];
				
					session_write_close();
					header("Location: recap.php");
					exit;
               }else{
                    $msg_demande_confirm = "Vous devez comfirmer votre compte pour se connecter !";
		       }
			}



            elseif($resultat_etud4a) {
				if($resultat_etud4a['confirme'] == 1){

					$_SESSION["connexion"]="condidat";
			
					$_SESSION['utilisateur_table'] = 'etud4a';
					$_SESSION['utilisateur_id'] = $resultat_etud4a['id'];
					$_SESSION['utilisateur_login'] = $resultat_etud4a['log'];
					$_SESSION['utilisateur_pass'] = $resultat_etud4a['mdp'];
			
					session_write_close();
					header("Location: recap.php");
					exit;
				}else{
                    $msg_demande_confirm = "Vous devez comfirmer votre commpte pour se connecter !";
		       }
            }
			
			else{ 
                $message = 'Login ou mot de passe incorrect !';
            }
    }
}

?>

<?php
 if (isset($_GET['mesg'])) {

    echo "<script>alert('" .$_GET['mesg']. "')</script>";    // message pour la validation d'inscription
}
?>





<!DOCTYPE HTML>
<html>
	<head>
		<title>Connexion</title>
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
						    <li><a href="inscription.php" class="button">S'inscrire</a></li>
						</ul>
					</nav>
				</header>

		
				<section id="main" class="container medium">
					<header>
						<h2>Connexion</h2>
						<p>Entrez vos informations pour se connecter.</p>
					</header>
					<div class="box">
                    <?php if (!empty($msg_demande_confirm)) { echo '<p style="color:red;">'.$msg_demande_confirm.'</p>'; } ?>
					<?php if (!empty($message)) { echo '<p style="color:red;">'.$message.'</p>'; } ?>
                  
						<form method="post" action="">
							<div class="row gtr-50 gtr-uniform">

								<div class="col-12">
							     	<input type="text" name="login" id="name" value="" placeholder="Login" />
								</div>

								<div class="col-12">
							     	<input type="password" name="mdp" id="name" value="" placeholder="Mot de passe" />
								</div>

								<div class="col-12">
									<ul class="actions special">
										<li><input type="submit" name="submit" value="Se connecter"/></li>
										<li><input type="reset"  name="annuler" value="Annuler" class="alt"  /></li>
									</ul>
								</div>
								
							</div>
						</form>
					</div>
				</section>

		
		
		<footer id="footer">
				<ul class="copyright">
				    <li><img src="fpdf/Universite_Cadi_Ayyad.png" alt="ENSA-M" width="100" height="90"></li>
					<li>&copy; 2023 ENSA</li><li>Ecole Nationale des Sciences Appliquées de Marrakech .</li>
				</ul>	
		</footer>

		
   </div>

</body>
</html>




