<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion avec mysqli</title>
</head>
<body>
    <h1>Connexion avec mysqli</h1>
    <h2>Méthode procédurale</h2>
    <h3>mysqli_connect</h3>
    <p>Voir la page sur <a href="https://www.php.net/manual/fr/mysqli.construct.php" target="_blank">php.net</a></p>
    <code><pre>
$mysqliConnect = mysqli_connect(
    "localhost", // hôte
    "root", // utilisateur
    "", // mot de passe
    "statistiques", // nom de la DB
    3306, // port (localhost:3306)
    // socket (optionnel)
    );

var_dump($mysqliConnect);
    </pre></code>
    <h4>Connexion</h4>
    <p>Connexion avec un var_dump pour tester notre connexion</p>
    <?php
    // connexion à la DB mysql "statistiques"
    $mysqliConnect = mysqli_connect("localhost","root","","statistiques",3306);
    var_dump($mysqliConnect);
    ?>
    <h4>Déconnexion</h4>
    <p>Optionnel mais doit être mis pour les bonnes pratiques.<br>En effet en mysql ou mariaDB les connexions se ferment automatiquement en fin de script. ! En cas de connexion permanente, il ne faut pas l'utiliser!<br>Les connexions permanentes sont utilisées sur les gros serveurs ayant les capacités de les supporter (gain de vitesse)</p>
    <h3>mysqli_close</h3>
    <code><pre>
mysqli_close($mysqliConnect);

var_dump($mysqliConnect);
    </pre></code>
    <?php
mysqli_close($mysqliConnect);

var_dump($mysqliConnect);
    ?>
</body>
</html>
<?php
