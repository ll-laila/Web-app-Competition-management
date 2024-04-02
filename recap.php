<?php
session_start();

require_once("fonctions.php");

if($_SESSION["connexion"] = "condidat"){

    $table = $_SESSION['utilisateur_table'];
    $log = $_SESSION['utilisateur_login'];
    $pass = $_SESSION['utilisateur_pass'];    

    $condidat= get_condidat($table,$log,$pass);

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
     
}

else{

    header("location:autentification.php");
    exit();
}

?>

<?php 

if (isset($_GET['message']) && !isset($_SESSION['message_affiche'])) {
   
	$msg = $_GET['message'];                                   //msg pour la modification
    echo "<script>alert(\"$msg\")</script>";                   //la session si pour éviter l'affichage de ce msg à chaque fois lorsqu'on actualise la page
    $_SESSION['message_affiche'] = true;

    $new_info = $_SESSION['condidat_mod'];
}

?>




<!DOCTYPE HTML>
<html>
	<head>
		<title>Récapitulatif de candidature</title>
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
							<li><a href="index.php" class="button">Déconnecter</a></li>
						</ul>
					</nav>
				</header>

	 
			<section id="main" class="container">
				<header>
					<h2>Récapitulatif de votre candidature</h2>
					<hr>
				</header>

				<section class="box">

				  <?php 
					if(isset($new_info['photo'])) {
						$img_identite = $new_info['photo']; 
					}else{
						$img_identite = $photo ; 
					}
					echo '<div><img src="'. $img_identite. '" alt="Photo d\'identité" width="110" height="110"></div>';
			      ?>


					<div class="table-wrapper">
						<table>
								<tr>
									<td>Nom:</td>
									<td><?php if(isset($new_info['nom'])) print $new_info['nom']; else print @$nom; ?></td>
								</tr>
				
								<tr>
									<td> Prénom:</td>
									<td><?php if(isset($new_info['prenom'])) print $new_info['prenom']; else print @$prenom; ?></td>
								</tr>
				
								<tr>
									<td> email:</td>
									<td><?php if(isset($new_info['email'])) print $new_info['email']; else print @$email; ?></td>
								</tr>
				
								<tr>
									<td> date de naissance:</td>
									<td><?php if(isset($new_info['naissance'])) print $new_info['naissance']; else print @$naissance; ?></td>
								</tr>
				
								<tr>
									<td> Diplôme:</td>
									<td><?php if(isset($new_info['diplome'])) print $new_info['diplome']; else print @$diplome; ?></td>
								</tr>
				
								<tr>
									<td> Niveau:</td>
									<td><?php if(isset($new_info['niveau'])) print $new_info['niveau']; else print @$niveau; ?></td>
								</tr>
				
								<tr>
									<td>Établissement d'origine :</td>
									<td><?php if(isset($new_info['etablissement'])) print $new_info['etablissement']; else print @$etablissement; ?></td>
								</tr>
				
								<tr>
									<td>login:</td>
									<td><?php echo @$log; ?></td>
								</tr>
				
								<tr>
									<td>mot de passe:</td>
									<td><?php if(isset($new_info['mdp'])) print $new_info['mdp']; else print @$mdp; ?></td>
								</tr>
				
								<tr>
									<td>Photo d'identité :</td> 
									
									<td> <?php
											if(isset($new_info['photo'])) { 
												$photo = $new_info['photo'];
												print "<a href=$photo>votre photo</a>";
											}
											else{
												print "<a href=$photo>votre photo</a>"; } ?>
									</td>
								</tr>
				
								<tr>
									<td>CV:</td>
									<td><?php
											if(isset($new_info['cv'])) {
												$cv = $new_info['cv'];
												print "<a href=$cv>votre cv</a>";
											}
											else{
												print "<a href=$cv>votre cv</a>"; } ?></td>
								</tr>
				         </table>	

							 
						 <div style="display: flex;">
						 
								<form method="post" action="modifier_compte.php" style="flex: 1;" >
								   <input type="submit" name="modifier_compte" value="Modifier mes informations" style="width: 240px;">
								</form>

								<form method="post" action="supprimer_compte.php" style="flex: 1;">
								   <input type="submit" name="supprimer" value="Supprimer mon compte" style="width: 240px;" onclick="return confirm('Voulez-vous vraiment supprimer votre compte? Cette action est irréversible.')">
								</form>
           
								<form method="post" action="reçu_pdf.php" style="flex: 1;">
								   <input type="submit" name="pdf" value="reçu d'inscription" style="width: 240px;">
								</form>

								 <p><?php  if(isset($_GET['erreur']))  print $_GET['erreur']  // pdf ?></p>
                         </div>


							
					</div>
				</section>
			</section>
		</div>


        <footer id="footer">
				<ul class="copyright">
				    <li><img src="style/images/Universite_Cadi_Ayyad.png" alt="ENSA-M" width="100" height="90"></li>
					<li>&copy; 2023 ENSA</li><li>Ecole Nationale des Sciences Appliquées de Marrakech .</li>
				</ul>	
		</footer>


</body>
</html> 
