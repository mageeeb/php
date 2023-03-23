<?php
// transformation en variable locale
$idRubriques = (int) $_GET['section'];

// requête pour le menu des rubriques
$sql = "SELECT idrubriques, rub_title FROM rubriques
# WHERE idrubriques = 20
 ORDER BY rub_title ASC;";
// exécution de la requête
$query = mysqli_query($db,$sql) or die('Erreur de $query');
// transformation en tableau indexé contenant des tableaux associatifs
$resultatRubriques = mysqli_fetch_all($query, MYSQLI_ASSOC);

// requête pour récupérer l'auteur
$sql = "SELECT rub_title, rub_text FROM rubriques
        WHERE idrubriques  = $idRubriques
";
// exécution de la requête
$query = mysqli_query($db,$sql) or die('Erreur de $query');

// on compte le nombre d'auteur
$nbRubriques = mysqli_num_rows($query);

// transformation en tableau associatif
$resultatRubriques = mysqli_fetch_assoc($query);

// requête qui récupère tous articles de l'auteur avec 255 caractères de texte avec les rubriques cliquables pour notre page d'auteur

$sql="SELECT a.idrubriques , a.rub_title, a.rub_text,
SUBSTR(a.rub_text,1,250) AS rub_text,
GROUP_CONCAT(r.idrubriques) AS idrubriques,
GROUP_CONCAT(r.rub_title SEPARATOR '|||') AS rub_title 
FROM `article` a 

    LEFT JOIN articles_has_rubriques ahr
    ON ahr.articles_idarticles = a.idarticles
    LEFT JOIN rubriques r
    ON ahr.rubriques_idrubriques = r.idrubriques
    
   

       
    
    
    on groupe par l'index (clef primaire) de la table principale (FROM articles)
    */
    GROUP BY a.idrubriques 
    classement par date de l'article descendant 
    ORDER BY a.art_date DESC
    "
    ;

    // exécution de la requête
    $query = mysqli_query($db,$sql) or die('Erreur de $query');
    // nombre d'articles récupérés
    $nbRubriques = mysqli_num_rows($query);
    // transformation en tableau indexé contenant des tableaux associatifs
    $resultatRubriques = mysqli_fetch_all($query, MYSQLI_ASSOC);