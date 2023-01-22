<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article : <?=$resultatArticles['art_title']?></title>
</head>
<body>
    <h1>Article : <?=$resultatArticles['art_title']?></h1>
    <?php
    include "inc/menuPublicView.php";
    ?>
    
    
    <div class="article">
    <h3><?=$resultatArticles['art_title']?></h3>
    <?php
    // si on a des rubriques
if (!empty($resultatArticles['idrubriques'])):
    // conversion des chaînes de caractères contenant les id des sections et leurs noms en tableaux
    $idsection = explode(",", $resultatArticles['idrubriques']);
    $nomsection = explode("|||", $resultatArticles['rub_title']);

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
    <p><?=nl2br($resultatArticles['art_text'])?></p>
    <h4>Ecrit par <a href="?auteur=<?=$resultatArticles['idusers']?>"><?=$resultatArticles['user_login']?></a> le <?=$resultatArticles['art_date']?></h4>
    <hr>


    </div>

</body>
</html>