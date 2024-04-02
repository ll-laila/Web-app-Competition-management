<?php require_once('fonctions.php');

if(isset($_POST['table3'])) {
    $notif ="";
    $resultat = supprimerNonConfirmes('etud3a');

    if ($resultat) {
        $notif = "Les candidats non confirmés ont été supprimés avec succès.";
    } else {
        $notif = "Aucun candidat non confirmé n'a été supprimé.";
    }
}
if(isset($_POST['table4'])) {
    $notif ="";
    $resultat = supprimerNonConfirmes('etud4a');

    if ($resultat) {
        $notif = "Les candidats non confirmés ont été supprimés avec succès.";
    } else {
        $notif = "Aucun candidat non confirmé n'a été supprimé.";
    }
}
?>



<!DOCTYPE HTML>
<html>
	<head>
		<title>gérer les comptes</title>
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
                            <li><a href="administration.php">Administration</a>
                            <li><a href="index.php" class="button">Déconnecter</a></li>
						</ul>
					</nav>
				</header>

	
			<section id="main" class="container">
				<header>
					<h2>les comptes des candidats inscrites</h2><hr>
				</header>


				<section class="box">
                <?php if (!empty($notif)) { echo '<p style="color:red;">'.$notif.'</p>'; } ?>
				  <h3>Inscriptions au concours 3ème année</h3><hr>
					<div class="table-wrapper">
                            <table >
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>		
                                        <th>confirm_code</th>
                                        <th>confirme</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $resultat_etud3a = afficher('etud3a'); 
                                            foreach ($resultat_etud3a as $row) {

                                                echo '<tr>';
                                                echo '<td>' . $row['nom'] . '</td>';
                                                echo '<td>' . $row['prenom'] . '</td>';
                                                echo '<td>' . $row['email'] . '</td>';
                                                echo '<td>' . $row['confirm_code'] . '</td>';
                                                echo '<td>' . $row['confirme'] . '</td>';
                                                echo '</tr>'; 
                                            }
                                        ?>
                            
                                    </tbody>
                            </table>

                            <form action="" method="post">
                                <div class="col-3 col-12-mobilep">
                                    <input type="submit" name="table3"  value="Supprimer les candidats non confirmés" class="fit" />
                                </div>
                            </form>	
					</div>
				</section>

                <hr>

                <section class="box">
				  <h3>Inscriptions au concours 4ème année</h3><hr>	
					<div class="table-wrapper">
                       <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>		
                                    <th>confirm_code</th>
                                    <th>confirme</th>
                                </tr>
                            </thead>
                            <tbody>

                                    <?php
                    
                                        $resultat_etud4a = afficher('etud4a'); 
                                        foreach ($resultat_etud4a as $row) {

                                            echo '<tr>';
                                            echo '<td>' . $row['nom'] . '</td>';
                                            echo '<td>' . $row['prenom'] . '</td>';
                                            echo '<td>' . $row['email'] . '</td>';
                                            echo '<td>' . $row['confirm_code'] . '</td>';
                                            echo '<td>' . $row['confirme'] . '</td>';
                                            echo '</tr>'; 
                                        }
                    
                                    ?>
                        
                            </tbody>
                        </table>
                             <form action="" method="post">
                                <div class="col-3 col-12-mobilep">
                                    <input type="submit" name="table4"  value="Supprimer les candidats non confirmés" class="fit" />
                                </div>
                            </form>	
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