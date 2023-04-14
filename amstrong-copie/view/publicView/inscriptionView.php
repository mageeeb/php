
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Inscription</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <?php
    var_dump($_POST);
    ?>
    <div class="inscription clearfix">
        <form action="" method="POST">
          <h2>Inscription</h2>
          <input type="text" name="pseudo" placeholder="Tapez votre nom">
          <br>
          <input type="password" name="pwd" id="pass1" autocomplete="off"
                 placeholder="Tapez votre mot de passe"
                 data-help="6 caractères minimum, au moins 1 majuscule et 1 chiffre">
          <br>
          <input type="password" name="pass2" id="pass2" autocomplete="off"
                 placeholder="Retaper votre mot de passe">
          <br>
          <input type="submit" name="envoi">
        </form>
        <div class="message">
          
        </div>
        </div>
       
</body>
</html>