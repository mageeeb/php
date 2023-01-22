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
// si il n'existe pas de variable get nommée section ET de variable get nommée article ET de variable get nommée auteur ET de variable get nommée admin
if(!isset($_GET['section']) && !isset($_GET['article']) && !isset($_GET['auteur']) && !isset($_GET['admin'])){

        // appel du contrôleur de la homepage
        include_once '../controller/homepageController.php';

        // appel de la vue
        include_once '../view/homepageView.php';

// Si on est sur le détail d'un article (existence de la variable get article et qu'elle ne contient que du numérique entier non signé)
}elseif(isset($_GET['article']) && ctype_digit($_GET['article'])){

    // appel du contrôleur de la page de détail d'un article
    include_once "../controller/detailController.php";
        
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

// Si on est sur le détail d'un auteur
}elseif(isset($_GET['auteur']) && ctype_digit($_GET['auteur'])){

    // appel du contrôleur de la page de détail d'un article
    include_once "../controller/auteurController.php";
        
        // si on a trouvé l'auteur
    if ($nbAuteur!==0) {
        // appel de la vue
        include_once '../view/auteurView.php';
    // sinon
    }else{
        // Erreur plus d'article
        $error = "Cet auteur n'existe pas";
        // on appel l'erreur 404
        include_once '../view/404View.php';
    }   

    /* nous sommes ici */

// Si on est sur l'admin
}elseif(isset($_GET['admin'])){

    // requête pour le menu des rubriques
    $sql = "SELECT idrubriques, rub_title FROM rubriques
    # WHERE idrubriques = 20
    ORDER BY rub_title ASC;";
    // exécution de la requête
    $query = mysqli_query($db,$sql) or die('Erreur de $query');
    // transformation en tableau indexé contenant des tableaux associatifs
    $resultatRubriques = mysqli_fetch_all($query, MYSQLI_ASSOC);

    // si le formulaire POST est envoyé
    if(isset($_POST['art_title'],$_POST['art_text'],)){
        // traitement de sécurité https://listphp.webdev-cf2m.be/ -> priorité des (), d'abord le trim, retire les espaces vides devant et derrière, puis le strip_tags qui retire tous les tags html, css, js etc..., puis htmlspecialchars qui encode les caractères dangereux en entités html, le ENT_QUOTE lui permet de convertire les caractères : ' et "
        $title = htmlspecialchars(strip_tags(trim($_POST['art_title'])),ENT_QUOTES);
        $texte = htmlspecialchars(strip_tags(trim($_POST['art_text'])),ENT_QUOTES);
        
        // si ils ne sont pas vides
        if(!empty($title)&&!empty($texte)){
            //on crée la requête
            $sql = "INSERT INTO articles (art_title,art_text) VALUES ('$title','$texte');";
            //on effectue l'insertion
            mysqli_query($db,$sql) or die (mysqli_error($db));
            // redirection vers l'accueil'
            header("Location: ./");
        }
    }

    // on appel la vue
    include_once '../view/adminView.php';
}