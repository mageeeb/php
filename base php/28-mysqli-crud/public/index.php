<?php


/*

chargement des dépendances

*/

require_once "../config.php";

/*

 connexion à la DB

 */

// essai
try{
    // connexion - $db est donc une instance d'un objet mysqli
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    //var_dump($db);
    // mise à jour du charset
    mysqli_set_charset($db, DB_CHARSET);
// erreur ($e est une instance de la classe Exception qui contient l'exception)
}catch(Exception $e){
    // affichage de l'erreur et arrêt du script
    // version avant PHP 8.2, est dépréciée car elle ne dit pas de quel format on part pour encoder en utf8, une nouvelle fonction est créée pour le français : iso8859_1_to_utf8($string); ! ne fonctionnera qu'à partir de PHP 8.2
    // exit(utf8_encode($e->getMessage()));
    // pour le moment on utilise une bibliothèque intégrée pour faire la même chose (conversion de ISO-8859-1 vers utf8)
    exit(mb_convert_encoding($e->getMessage(),'UTF-8','ISO-8859-1'));
}

/*

Router


 */

// si on est sur la page d'accueil
// si il n'existe pas de variable get nommée section ou de variable get nommée article ou de variable get nommée auteur
if(!isset($_GET['section']) && !isset($_GET['article']) && !isset($_GET['auteur'])){

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


        // appel de la vue
        include_once '../view/homepageView.php';

// Si on est sur le détail d'un article (existence de la variable get article et qu'elle ne contient que du numérique entier non signé)
}elseif(isset($_GET['article']) && ctype_digit($_GET['article'])){

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
        
        // si on a un article (strictement différent de 0)
if ($nbArticles!==0) {
    // appel de la vue
    include_once '../view/detailView.php';
    // sinon
}else{
    // Erreur plus d'article
    $error = "Cet article n'existe plus";
    // on appel l'erreur 404
    include_once '../view/404View.php';
}

}