<?php
// transformation en variable locale
$idAuteur = (int) $_GET['auteur'];

// requête pour le menu des rubriques
$sql = "SELECT idrubriques, rub_title FROM rubriques
# WHERE idrubriques = 20
 ORDER BY rub_title ASC;";
// exécution de la requête
$query = mysqli_query($db,$sql) or die('Erreur de $query');
// transformation en tableau indexé contenant des tableaux associatifs
$resultatRubriques = mysqli_fetch_all($query, MYSQLI_ASSOC);

/* nous sommes ici */