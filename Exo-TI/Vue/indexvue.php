<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/styles.css">
    <title>Site pour le TI</title>
</head>

<body>
    <section id="contact">
        <div class="container">
            <div class="titre">
                <h1>Une question ? Un conseil ?</h1>
                <h2>Contactez-nous</h2>
            </div>

            <form name="insertArticle" method="POST">
                <input type="text" name="nomadesses" id="" placeholder="Entrer votre nom" required>
                <input type="email" name="mailadresses" id="" placeholder="Entrer votre email" required>
                <button type="submit">Envoyer</button>

                <?php

                if (!empty($item['idadresses'])) :

                    $idsection = explode(",", $item['idadresses']);
                    $nomsection = explode("|||", $item['nomadresses']);
                    //var_dump($item)
                ?>
                <?php
                endif;
                ?>
            </form>
        </div>

    </section>
</body>

</html>