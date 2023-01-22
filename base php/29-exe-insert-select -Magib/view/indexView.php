<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - envoi d'un article</title>
</head>

<body>
    <h1>Administration - envoi d'un article</h1>

    <hr>
    <div class="adresses">
        <form name='insertArticle' method="POST" action="">
            <input name='nomadresses' type="text" placeholder="votre nom et prénom" required /><br>
            <input name='mailadresses' type="text" placeholder="votre adresse mail" required /><br>
            <input type="submit" value="Envoyer">

            
             <?php
        foreach($adresses AS $item):
        
            /* if(isset($message)){
        echo $message;
    } */
            ?>


            <p><?= $item['nomadresses'] ?>... <a href="?adresse=<?= $item['idadresses'] ?>">Lire la suite</a></p>
            le <?= $item['dateadresses'] ?></h4>
            <hr>


            <?php
            // si on a des rubriques
            if (!empty($item['idadresses'])) :
                // conversion des chaînes de caractères contenant les id des sections et leurs noms en tableaux
                $idsection = explode(",", $item['idadresses']);
                $nomsection = explode("|||", $item['nomadresses']);
                // var_dump($item)
            ?>
            <?php
            endif;
            ?>

            <?php
            endforeach;
            ?>

        </form>
    </div>

</body>

</html>