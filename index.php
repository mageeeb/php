<?php

/*

CECI EST NOTRE CONTROLEUR FRONTAL

*/

/*
DEPENDANCES
*/

// Appel des dépendances - ici config.php contient des constantes "vitales", on ne peut afficher le site que si on arrive  à les charger (require) et on ne peut le charger qu'une fois (require_once) sinon on aura des erreurs de redéfinition de constantes.
//require_once "geographie.php";

/*
ROUTER
*/

// si il existe une variable get nommée page (on a cliqué sur un lien)
if(isset($_GET['p'])){
    
    // utilisation du switch
    switch($_GET['p']){
        case 'form':
            include "pages/contact.php";
            break;
        case 'hist':
            include 'pages/histoire.php';
            break;
        case 'gal':
            include 'pages/gallery.php';
            break;
        case 'link':
            include 'pages/liens.php';
            break;
        case 'cult':
            include 'pages/culture.php';
            break;
        case 'geo':
            include 'pages/geographie.php';
            break;
        default:
            include_once "pages/homepage.php";
    }

// sinonpas de $_GET['page'];    
}else{
    // inclusion d'homepage une seule X
    include_once "pages/homepage.php";
}
