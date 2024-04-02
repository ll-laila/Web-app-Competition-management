<?php
require("fonctions.php");


    // Récupération de la saisie de l'utilisateur
    $nom = $_POST['nom'];

    // Création de la requête SQL pour rechercher les candidats avec le nom spécifié
    $query = "SELECT nom, prenom FROM etud3a WHERE nom LIKE ? UNION SELECT nom, prenom FROM etud4a WHERE nom LIKE ?";
    $stmt = connect()->prepare($query);
    $stmt->execute(["$nom%", "$nom%"]);

    // Construction de la chaîne de caractères contenant les propositions
    $propositions = "";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $propositions .= "<div onclick=\"selectCandidat('" . $row['nom'] . " " . $row['prenom'] . "')\">" . $row['nom'] . " " . $row['prenom'] . "</div>";
    }

    // Renvoi de la chaîne de caractères contenant les propositions
    echo $propositions;
?>




  






