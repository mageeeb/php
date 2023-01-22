<?php
/*

fonction qui calcule 2 numériques avec les symboles + - * /, les champs numériques sont obligatoires, le champs $op contient + par défaut

function calculBasicWithInstruction(

    $num1, => obligatoire (float ou int)

    $num2, => obligatoire (float ou int)

    $op = "+" => string non obligatoire, possibilités : "+" , "-" , "*" , "/"
    ) 
    retourne => chaîne de caractères (string) composée du calcul et du résultat

*/
function calculBasicWithInstruction($num1, $num2, $op = "+"){

    // les états possibles et acceptables de $op
    $possibiliteOp = ["+","/","*","-"];

    // si ce n'est pas dans le tableau acceptable => in_array vérifie si un élément est bien dans les valeurs d'un tableau
    if(!in_array($op,$possibiliteOp)){
        return "Ne sont accepté que + - * / !";
    }

    // on inverse la condition avec !, attention le && devient ||
    if(!is_numeric($num1)||!is_numeric($num2)){
        return "Attention, les 2 premiers paramètres doivent être numériques";
    }
    switch ($op){
        case "*":
            return $num1." ".$op." ".$num2." = ".($num1*$num2); // le return arrête la fonction et renvoie le résultat
            break; // break facultatif dans ce cas particulier
        case "-":
            return $num1." ".$op." ".$num2." = ".($num1-$num2);
            break;
        case "/":
            // si division par 0 affichage de l'erreur et arrêt du script
            if($num2==0) return "Division par 0 interdite";
            return $num1." ".$op." ".$num2." = ".($num1/$num2);
            break;
        default:
            return "$num1 $op $num2 = ".($num1+$num2);
    }
}