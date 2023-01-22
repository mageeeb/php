<?php

/*
reçoit un int avec le nombre d'habitants
renvoie un string avec la convertion en millions (avec 2 chiffres après la virgule)

en Inde : perMillion(1210193422) => "1210.19 Millions"
à Andorre : perMillion(85959) => "0.08 Million"

A partir de 2 millions on rajoute s à "Million"

*/
function perMillion(int $number): string {

    /* méthode 1 commentée
    // conversion en million => $number / 1 000 000
    $millions = $number/1000000;

    // arrondir à 2 chiffres après la virgule : https://www.php.net/manual/fr/function.round.php
    $millions = round($millions,2);

    // si plus ou égal à 2 millions
    if($millions >= 2 ){
        return "$millions Millions";
    }

    // si le if est faux (return non exécuté plus haut -> plus petit que 2 millions)
    return "$millions Million";
    */
    /* méthode 2 commentée 
    // utilisation de number_format : https://www.php.net/manual/fr/function.number-format
    $millions = number_format(($number/1000000),2,',','');
    if($millions >= 2 ){
        return "$millions Millions";
    }
    return "$millions Million";
    */
    /* méthode 3 - 1 sur une ligne */
    $number=round($number/1000000,2); return ($number>=2)? "$number Millions": "$number Million";
}
