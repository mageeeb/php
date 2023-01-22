# 28 - mysqli - crud

## Installation

1) Ouvrez PHPMyAdmin et choisissez MariaDB
2) Importez `datas/export-23-01-16.sql` à la base de votre serveur.
3) Ouvrez `config.php.ini` et enregistrez le sous le nom de `config.php`.
4) Vérifiez vos paramètres de connexion.

## Structure

### contrôleur frontal

        /public/index.php

Dans `public` se trouveront :

- index.php  
- les dossiers visibles pour l'utilisateur (front-end) : `css`, `img`, `js`

### Les vues

        /view/
        /view/404View.php
        /view/detailView.php
        /view/homepageView.php

Se trouvent dans un dossier non accessible pour les utilisateurs, ce sont les contrôleurs, via le contrôleur frontal qui les appellera.
