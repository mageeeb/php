<?php

/*

Front controller -> index.php

*/

/*

Appel des dépendances

*/
require_once "config.php";


// (modèle)
include "functions.php";

/*

Routage (router), ou liens vers d'autres controleurs

*/
if(isset($_GET['page'])){

    // si le nom de la variable get existe dans le tableau NOM_DE_PAGES
    if(in_array($_GET['page'],NOM_DE_PAGES)){

        // on charge la page (qui doit exister !)
        include "pages/".$_GET['page'].".php";
        
    }else{
        include "pages/404.php";
    }
}else{
    include "pages/homepage.php";
}


