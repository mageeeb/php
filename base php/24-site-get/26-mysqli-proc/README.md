# Choix de mysqli 

Nous faisons le choix de mysqli procédural pour nos connexions.

Il existe une version mysqli OO (orienté objet) et une autre procédurale.

Nous passerons à l'OO plus tard, et de préférence avec PDO :

https://www.php.net/manual/fr/mysqlinfo.api.choosing.php

Car :

### PDO :

Interface orientée objet -> Oui
Interface procédurale->Non

### mysqli :

Interface orientée objet -> Oui
Interface procédurale-> **Oui**

## Création d'un .gitignore

On crée un .gitignore pour ne pas envoyer notre fichier config.php sur github pour des questions de sécurité. 

config.php.create en est une copie sans les vrais paramètres de connexion !

## transtypage

Le transtypage automatique d'un langage permet de transformer à la vollée une variable d'un type vers un autre.

Il est activé par défaut en PHP

$i = "5";

// EN SQL le transtypage fonctionne aussi, sauf pour les LIMIT

        SELECT * FROM statistiques WHERE ID = $i ; // fonctionne "5" est converti en 5
        SELECT * FROM statistiques LIMIT 0 , $i ; // erreur, le transtypage ne fonctionne pas dans ce cas -> "5"


