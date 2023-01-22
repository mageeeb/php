<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auteur : ? </title>
</head>
<body>
/* nous sommes ici */
    <h1>Auteur : ? </h1>
    <?php
    include "inc/menuPublicView.php";
    ?>
    
    <?php
    // pas d'articles
    if(empty($resultatArticles)):
    ?>
    <h2>Pas encore d'articles par cet auteur</h2>
    <?php
    // au moins un article
    else:
    ?>
    <h2>Nombre d'articles: <?=$nbArticles?></h2>
    <?php
        foreach($resultatArticles as $item):
            ?>
    <div class="article">
    <h3><?=$item['art_title']?></h3>
    <?php
    // si on a des rubriques
if (!empty($item['idrubriques'])):
    // conversion des chaînes de caractères contenant les id des sections et leurs noms en tableaux
    $idsection = explode(",", $item['idrubriques']);
    $nomsection = explode("|||", $item['rub_title']);

    // variable pour les rubriques
    $rubriques = "";
    // tant que l'on a des rubriques
    foreach ($idsection as $clef => $valeur) {
        $rubriques .= "<a href='?section=$valeur'>{$nomsection[$clef]}</a> | ";
    }

    ?>
    <h4><?=$rubriques?></h4>
    <?php
endif;
    ?>
    <p><?=$item['art_text']?>... <a href="?article=<?=$item['idarticles']?>">Lire la suite</a></p>
    <h4>Le <?=$item['art_date']?></h4>
    <hr>


    </div>
            <?php
        endforeach;
    endif;
    ?>
</body>
</html>