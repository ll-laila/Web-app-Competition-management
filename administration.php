<!DOCTYPE HTML>
<html>
<head>
    <title>Recherche Candidat</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="style/assets/css/main.css" />
    
	<script type='text/javascript'>


        function getXhr(){
            var xhr = null;
		    if(window.XMLHttpRequest) 
				xhr = new XMLHttpRequest(); 
			else if(window.ActiveXObject){ 
				try {
			          xhr = new ActiveXObject("Msxml2.XMLHTTP");
			    } catch (e) {
			          xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
			}
			else { 
				alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
				xhr = false; 
			} 
            return xhr;
		}

		
     

		function rechercheCandidat() {
			var recherche = document.getElementById("cherche_cond");
			if(recherche.value=="") {
				document.getElementById("propositions").style.visibility="hidden";
			} else {
				var xhr = getXhr();
				var recherche = document.getElementById("cherche_cond").value;
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {

						if(xhr.responseText=="") {
						    document.getElementById("propositions").style.visibility="hidden";
						}
						else{ 
							document.getElementById("propositions").style.visibility="visible";
							document.getElementById("propositions").innerHTML = this.responseText;
						}
					}
					else {
						document.getElementById("propositions").innerHTML = '<img src="style/images/loading4.gif" alt="Chargement en cours..." style="display: block; margin: 0 auto; width: 9%; margin-top: 6px;">';

					}                                                
				};

				xhr.open("POST", "recherche_candidat.php", true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.send("nom=" + recherche);
			}
		}


        function selectCandidat(nomComplet) {
            document.getElementById("cherche_cond").value = nomComplet;
        }

    </script>

	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<header id="header">
				<h1><a href="index.php">ENSA</a> - concours</h1>
				<nav id="nav">
		 			<ul>
						<li><a href="administration.php">Administration</a>
						<li><a href="index.php" class="button">Déconnecter</a></li>
	                </ul>
				</nav>
			</header>

			<section id="main" class="container medium">
				<header>
					<h2>Espace d'administrateur</h2><hr>
				</header>

			  <div class="box">
				<form action="" method="post">
					<div class="row gtr-uniform gtr-50">

							<div class="col-9 col-12-mobilep">
							   <input type="text" id="cherche_cond" name="nom_prenom" onkeyup="rechercheCandidat()">
                                <div id="propositions"></div>
							</div>
						
							<div class="col-3 col-12-mobilep">
								<input type="submit" value="Rechercher" name="info_cand" class="fit" />
							</div>
					
				    </div>
				</form>
					
		    <hr>

            <div>
			   <?php
				require("fonctions.php");

				if(isset($_POST["info_cand"])){
					@$infos = explode(" ", $_POST["nom_prenom"]);
					@$nom = $infos[0];
					@$prenom = $infos[1];

					$query = "SELECT * FROM etud3a WHERE nom = ? AND prenom = ? UNION SELECT * FROM etud4a WHERE nom = ? AND prenom = ?";
					$stmt = connect()->prepare($query);
					$stmt->execute([$nom, $prenom, $nom, $prenom]);

					if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						echo "<table>";
						echo "<tr><td>Nom :</td><td>" . $row['nom'] . "</td></tr>";
						echo "<tr><td>Prénom :</td><td>" . $row['prenom'] . "</td></tr>";
						echo "<tr><td>Email :</td><td>" . $row['email'] . "</td></tr>";
						echo "<tr><td>Date de naissance :</td><td>" . $row['naissance'] . "</td></tr>";
						echo "<tr><td>Diplôme :</td><td>" . $row['diplome'] . "</td></tr>";
						echo "<tr><td>Etablissement d'origine :</td><td>" . $row['etablissement'] . "</td></tr>";
						echo "<tr><td>Inscrit au concours du :</td><td>" . $row['niveau'] . "</td></tr>";
						$photo = $row['photo']; $cv = $row['cv'] ;
						echo "<tr><td>Photo d'identité :</td><td><a href= $photo>Voir la photo</a></td></tr>";
						echo "<tr><td>CV :</td><td><a href= $cv>Voir le cv</a></td></tr>";
						echo "</table>";
						
						echo "<a href='administration.php' class='button'>Annuler la recherche</a>";

					} else {
						echo "Aucun candidat trouvé avec ces informations.";
					}	
				}
				?>
			</div>


			<hr>

				<h3>Options supplémentaires:</h3>
					<ul>
					  <li><a href="lister.php">Gérer les inscriptions</a></li>
					  <li><a href="gérer_comptes.php">Gérer les comptes</a></li>
					</ul>
						
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





												

													

















































































