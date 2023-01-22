<?php
// requête qui récupère tous articles avec 255 caractères de texte avec l'auteur cliquable et les rubriques cliquables pour notre page d'accueil

$sql="SELECT a.idarticles, a.art_title, # selection de l'id de l'article et de son titre (a est l'alias de articles, voir près du FROM)
SUBSTR(a.art_text,1,250) AS art_text, # on coupe le texte de l'article pour n'en garder que 250 caractères (! 256 car décimal vers octal) et on crée un alias de sortie avec AS pour pouvoir gérer le tableau associatif dans un autre langage (PHP)
a.art_date,  # la date de l'article
u.user_login, u.idusers,  # Le login et mot de passe de l'auteur (u est l'alias de user voir près de INNER JOIN)

/* En MySQL et MariaDB, lorsqu'on utilise un GROUP BY, on utilise GROUP_CONCAT pour concaténer les lignes de résultat en un seul sans perdre de données */

GROUP_CONCAT(r.idrubriques) AS idrubriques, # on concatène les id, la virgule est le séparateur par défaut, on crée un alias de sortie
GROUP_CONCAT(r.rub_title SEPARATOR '|||') AS rub_title # on concatène les titre des sections, la virgule n'est plus un séparateur séucrisé, on met comme SEPARATOR les '|||' on crée un alias de sortie
FROM `articles` a # depuis la table article renommée en alias interne a

    /* Jointure interne (voir https://raw.githubusercontent.com/WebDevCF2m2022/bases-php-2022/main/28-mysqli-crud/SQL_Joins.svg ) car il n'existe pas d'articles sans auteurs, et si c'était le cas (non innoDB OU possibilité de NULL pour la clef étrangère), le INNER JOIN (qui équivaut à JOIN) ne prendra pas les articles qui n'ont pas d'auteurs !
    */

    INNER JOIN users u # on joint de manière interne users (alias u) à articles 
    ON u.idusers = a.users_idusers # condition de jointure 

    /* jointure externe (LEFT, dans l'ordre de lecture, par rapport à la table à gauche, juste après le FROM), prendra les articles, même si ils ne sont pas dans une rubrique
    Comme nous sommes en présence de many to many, il faut d'abord prendre la table de jointure (qui ne contient que des clefs étrangères)
    */
    LEFT JOIN articles_has_rubriques ahr # on joint la table de jointure qu'on renome ahr
    ON ahr.articles_idarticles = a.idarticles # condition de jointure entre la table article et celle de jointure
    LEFT JOIN rubriques r # on joint la table voulue par le many to many en utilisant la table de jointure et la table rubriques (renommée r)
    ON ahr.rubriques_idrubriques = r.idrubriques # condition de jointure entre la table jointure (ahr) et la table voulue (r)
    # WHERE a.idarticles = 5
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

    // requête pour le menu des rubriques
    $sql = "SELECT idrubriques, rub_title FROM rubriques
    # WHERE idrubriques = 20
     ORDER BY rub_title ASC;";
    // exécution de la requête
    $query = mysqli_query($db,$sql) or die('Erreur de $query');
    // transformation en tableau indexé contenant des tableaux associatifs
    $resultatRubriques = mysqli_fetch_all($query, MYSQLI_ASSOC);

    #var_dump($resultatRubriques);