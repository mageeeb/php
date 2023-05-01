<?php

$articleMenu = getCategoryMenu($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- On mettra le title dans une variable $title a renseigner en haut de chaque vue ex: $title = accueil  -->
    <title><?= $title ?></title>
    
    <link rel="stylesheet" href="css/style.css">
    <nav>
        <a href="?p=homePage">Accueil</a>
        
        <!-- lien pour les category : -->
        <?php
        foreach($articleMenu as $item) : 
        ?>

        <a href="?categoryId=<?=$item['id_category']?>"><?=$item['name_category']?></a>

        <?php
        endforeach;
        ?>
        <a href="?p=contact">Contact</a>
        <a href="?p=connect">Connexion</a>
       

    </nav>


