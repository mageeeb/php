<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur 404 - <?=$error?></title>
</head>
<body>
    <h1>Erreur 404</h1>
    <nav class="inline-block;">
        <a href="./">Accueil</a>
        <?php
        foreach($resultatRubriques AS $item):
        ?>
        <a href="?section=<?=$item['idrubriques']?>"><?=$item['rub_title']?></a>
        <?php
        endforeach;
        ?>
    </nav>
    <h2>Error 404 - <?=$error?></h2>
    
</body>
</html>