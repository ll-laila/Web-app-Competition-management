<?php require_once('fonctions.php');  ?>

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
                            <li><a href="administration.php">Administration</a>
                            <li><a href="index.php" class="button">Déconnecter</a></li>
						</ul>
					</nav>
				</header>

	
			<section id="main" class="container">
				<header>
					<h2>listes des inscriptions</h2><hr>
				</header>


				<section class="box">
				  <h3>Inscriptions au concours 3ème année</h3><hr>
					<div class="table-wrapper">
                            <table >
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Date de naissance</th>
                                        <th>Diplome</th>
                                        <th>niveau</th>
                                        <th>Établissement</th>
                                        <th>Photo</th>
                                        <th>cv</th>
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
                                                echo '<td>' . $row['naissance'] . '</td>';
                                                echo '<td>' . $row['diplome'] . '</td>';
                                                echo '<td>' . $row['niveau'] . '</td>';
                                                echo '<td>' . $row['etablissement'] . '</td>';
                                                $src_phpto=$row['photo']; 
                                                $src_cv=$row['cv']; 
                                                echo "<td>"."<a href=$src_phpto>Voir photo</a></td>";
                                                echo '<td>' ."<a href=$src_cv>Voir cv</a></td>";
                                                echo '</tr>'; 
                                            }
                                        ?>
                            
                                    </tbody>
                            </table>	
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
                                    <th>Date de naissance</th>
                                    <th>Diplome</th>
                                    <th>niveau</th>
                                    <th>Établissement</th>
                                    <th>Photo</th>
                                    <th>CV</th>
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
                                            echo '<td>' . $row['naissance'] . '</td>';
                                            echo '<td>' . $row['diplome'] . '</td>';
                                            echo '<td>' . $row['niveau'] . '</td>';
                                            echo '<td>' . $row['etablissement'] . '</td>';
                                            $src_phpto=$row['photo']; 
                                            $src_cv=$row['cv']; 
                                            echo "<td>"."<a href=$src_phpto>Voir photo</a></td>";
                                            echo '<td>' ."<a href=$src_cv>Voir cv</a></td>";
                                            echo '</tr>'; 
                                        }
                    
                                    ?>
                        
                            </tbody>
                        </table>
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