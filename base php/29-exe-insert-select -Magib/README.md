# exercice 29

Créez un formulaire permettant de recolter les mails et le nom des utilisateurs et de les mettre dans la table `adresses`.

Le CF est `public/index.php`
La vue est `view/indexView.php`

Il faut sur la même page afficher par date DESC toutes les adresses insérées.

Affichez "Pas encore d'adresses" si pas d'adresses.

Affichez une erreur si l'adresse existe déjà.

Affichez une erreur si le format de l'adresse n'est pas valide.

Affichez une erreur si un champs est vide.

La table doit être protégée contre les attaques !

Bonus 1: ne pas afficher les 5 premiers caractères des adresses (mais elles se trouvent dans la DB de manière complètes) :

        pitz michaël *****el.j.pitz@gmail.com

Bonus 2: ne pas afficher le nom mais sa première lettre en majuscule (même si il la met en minuscule) :

        P. michaël *****el.j.pitz@gmail.com

Bonus 3 : un peu de design ;-)