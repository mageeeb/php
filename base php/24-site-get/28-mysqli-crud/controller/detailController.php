<?php

// transformation en variable locale
$idArticle = (int) $_GET['article'];

// requête pour le menu des rubriques
$sql = "SELECT idrubriques, rub_title FROM rubriques
# WHERE idrubriques = 20
 ORDER BY rub_title ASC;";
// exécution de la requête
$query = mysqli_query($db,$sql) or die('Erreur de $query');
// transformation en tableau indexé contenant des tableaux associatifs
$resultatRubriques = mysqli_fetch_all($query, MYSQLI_ASSOC);

$sql="SELECT a.idarticles, a.art_title, a.art_text, a.art_date,
u.user_login, u.idusers,  # Le login et mot de passe de l'auteur (u est l'alias de user voir près de INNER JOIN)

GROUP_CONCAT(r.idrubriques) AS idrubriques, # on concatène les id, la virgule est le séparateur par défaut, on crée un alias de sortie
GROUP_CONCAT(r.rub_title SEPARATOR '|||') AS rub_title # on concatène les titre des sections, la virgule n'est plus un séparateur séucrisé, on met comme SEPARATOR les '|||' on crée un alias de sortie

FROM `articles` a # depuis la table article renommée en alias interne a

    INNER JOIN users u # on joint de manière interne users (alias u) à articles 
    ON u.idusers = a.users_idusers # condition de jointure 

    LEFT JOIN articles_has_rubriques ahr # on joint la table de jointure qu'on renome ahr
    ON ahr.articles_idarticles = a.idarticles # condition de jointure entre la table article et celle de jointure
    LEFT JOIN rubriques r # on joint la table voulue par le many to many en utilisant la table de jointure et la table rubriques (renommée r)
    ON ahr.rubriques_idrubriques = r.idrubriques # condition de jointure entre la table jointure (ahr) et la table voulue (r)
    WHERE a.idarticles = $idArticle
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
    $resultatArticles = mysqli_fetch_assoc($query);

    //var_dump($resultatArticles);