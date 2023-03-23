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

// requête pour récupérer l'auteur
$sql = "SELECT user_login, user_name FROM users
        WHERE idusers = $idAuteur
";
// exécution de la requête
$query = mysqli_query($db,$sql) or die('Erreur de $query');

// on compte le nombre d'auteur
$nbAuteur = mysqli_num_rows($query);

// transformation en tableau associatif
$resultatAuteur = mysqli_fetch_assoc($query);

// requête qui récupère tous articles de l'auteur avec 255 caractères de texte avec les rubriques cliquables pour notre page d'auteur

$sql="SELECT a.idarticles, a.art_title, a.art_date,
SUBSTR(a.art_text,1,250) AS art_text,
GROUP_CONCAT(r.idrubriques) AS idrubriques,
GROUP_CONCAT(r.rub_title SEPARATOR '|||') AS rub_title 
FROM `articles` a 

    LEFT JOIN articles_has_rubriques ahr
    ON ahr.articles_idarticles = a.idarticles
    LEFT JOIN rubriques r
    ON ahr.rubriques_idrubriques = r.idrubriques
    
    /*
Ici pas besoin de la jointure car $idAuteur est une clef étrangère de articles
        */
    
    WHERE a.users_idusers = $idAuteur
    /*
    on groupe par l'index (clef primaire) de la table principale (FROM articles)
    */
    GROUP BY a.idarticles
    /* classement par date de l'article descendant */
    ORDER BY a.art_date DESC
    "
    ;

    // exécution de la requête
    $query = mysqli_query($db,$sql) or die('Erreur de $query');
    // nombre d'articles récupérés
    $nbArticles = mysqli_num_rows($query);
    // transformation en tableau indexé contenant des tableaux associatifs
    $resultatArticles = mysqli_fetch_all($query, MYSQLI_ASSOC);
