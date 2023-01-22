<?php


/*

chargement des dépendances

*/

require_once "config.php";

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

// exemple

// création d'une variable de type string contenant du SQL (notre requête : 'sélectionne tout de la table articles')
$sql1="SELECT * FROM `articles`";

// création d'une variable contenant l'exécution de la requête (->objet), ou en cas d'erreur arrêt du script et affichage du texte
$query1 = mysqli_query($db,$sql1) or die('Erreur de $query1');

// var_dump($query1);

// création d'une variable contenant un tableau indexé contenant lui-même les résultats sous forme de sous tableaux associatifs (MYSQLI_ASSOC)
$resultat1 = mysqli_fetch_all($query1, MYSQLI_ASSOC);

//var_dump($resultat1);

// création d'une requête pour la page d'accueil qui va ramener tous les champs de la table `articles`, ainsi que le `users`.`user_login` et `users`.`idusers` correspondant

$sql2="SELECT a.*, u.user_login AS login, u.idusers FROM `articles` a
        INNER JOIN users u
        ON u.idusers = a.users_idusers ";

$query2 = mysqli_query($db,$sql2) or die('Erreur de $query2');

$resultat2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);

var_dump($resultat2);

//echo json_encode($resultat2);

// création d'une requête pour la page d'accueil qui va ramener tous les champs de la table `articles`, avec `articles`.`art_text` coupé à 250 caractères, ainsi que le `users`.`user_login` et `users`.`idusers` correspondant

$sql3="SELECT a.idarticles, a.art_title, SUBSTR(a.art_text,1,250) AS art_text, a.art_date, u.user_login, u.idusers FROM `articles` a
INNER JOIN users u
ON u.idusers = a.users_idusers ";

$query3 = mysqli_query($db,$sql3) or die('Erreur de $query3');

$resultat3 = mysqli_fetch_all($query3, MYSQLI_ASSOC);

var_dump($resultat3);

// création d'une requête pour la page d'accueil qui va ramener tous les champs de la table `articles`, avec `articles`.`art_text` coupé à 250 caractères, ainsi que le `users`.`user_login` et `users`.`idusers` correspondant, et tous les champs de toutes les rubriques dans lesquelles se trouvent les articles (! si l'article ne se trouve dans aucune rubrique, on veut le voir quand même)

$sql4="SELECT a.idarticles, a.art_title, 
    SUBSTR(a.art_text,1,250) AS art_text, a.art_date, 
    u.user_login, u.idusers, 
    r.*
    FROM `articles` a
        INNER JOIN users u
        ON u.idusers = a.users_idusers
        LEFT JOIN articles_has_rubriques ahr 
        ON ahr.articles_idarticles = a.idarticles
        LEFT JOIN rubriques r 
        ON ahr.rubriques_idrubriques = r.idrubriques
        "
        ;

$query4 = mysqli_query($db,$sql4) or die('Erreur de $query4');

$resultat4 = mysqli_fetch_all($query4, MYSQLI_ASSOC);

var_dump($resultat4);

// création d'une requête pour la page d'accueil qui va ramener tous les champs de la table `articles`, avec `articles`.`art_text` coupé à 250 caractères, ainsi que le `users`.`user_login` et `users`.`idusers` correspondant, et l'id et le titre de toutes les rubriques dans lesquelles se trouvent les articles (! si l'article ne se trouve dans aucune rubrique, on veut le voir quand même -> LEFT JOIN) ! nous souhaitons n'avoir qu'un résultat, mais avec tous les champs récupérés

$sql5="SELECT a.idarticles, a.art_title, 
    SUBSTR(a.art_text,1,250) AS art_text, a.art_date, 
    u.user_login, u.idusers, 
    GROUP_CONCAT(r.idrubriques) AS idrubriques, 
    GROUP_CONCAT(r.rub_title SEPARATOR '|||') AS rub_title
    FROM `articles` a
        INNER JOIN users u
        ON u.idusers = a.users_idusers
        LEFT JOIN articles_has_rubriques ahr 
        ON ahr.articles_idarticles = a.idarticles
        LEFT JOIN rubriques r 
        ON ahr.rubriques_idrubriques = r.idrubriques
        GROUP BY a.idarticles
        "
        ;

$query5 = mysqli_query($db,$sql5) or die('Erreur de $query5');

$resultat5 = mysqli_fetch_all($query5, MYSQLI_ASSOC);

var_dump($resultat5);