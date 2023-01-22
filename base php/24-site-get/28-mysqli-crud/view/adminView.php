<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - envoi d'un article</title>
</head>
<body>
    <h1>Administration - envoi d'un article</h1>
    <?php
    include "inc/menuPublicView.php";
    ?>
    
    <hr>
    <div class="article">
        <form name='insertArticle' method="POST" action="">
    <input name='art_title' type="text" placeholder="votre titre" required /><br>
    <textarea name='art_text' placeholder="votre texte" required></textarea><br>
    <input type="submit" value="Envoyer">

    <?php
    if(isset($message)){
        echo $message;
    }
    ?>
    </form>
    </div>

</body>
</html>