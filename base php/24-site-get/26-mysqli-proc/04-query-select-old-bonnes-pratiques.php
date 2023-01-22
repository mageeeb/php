<?php
require_once "config.php";

require "functions.php";

// connexion ancienne version

    // création d'une variable contenant la connexion
    $db = @mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);

    // si erreur
    if(mysqli_connect_errno()){
        // sortie et affichage du numéro de l'erreur et son message
        die("Erreur numéro : ".mysqli_connect_errno()." Message : ".mysqli_connect_error());
    }
    // mettre le charset à la connexion
    mysqli_set_charset($db, DB_CHARSET);

// sélectionne tout depuis la table stat ordonnée par nom ascendant
$sql = "SELECT * FROM statistiques #WHERE ID =700 
        ORDER BY nom ASC";

// requête sans try catch
$query = mysqli_query($db,$sql) or die("Erreur numéro : ".mysqli_errno($db)." Message : ".mysqli_error($db));

// comptons le nombre de résultats
$nb = mysqli_num_rows($query);

// si on a pas de résultats (0)
if(empty($nb)){
    // création du message
    $affiche = "Pas encore de pays dans notre programme";
}else{
    // mettre les résultats dans une variable de type tableau pour faire un foreach dans la vue
    $datas = mysqli_fetch_all($query,MYSQLI_ASSOC);
}

// bonnes pratiques on va vider les résultats
mysqli_free_result($query);
// bonnes pratiques on va fermer la connexion
mysqli_close($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <h1>Accueil</h1>
    <h2>Nombre de pays : <?=$nb?></h2>
    <?php
    if(isset($affiche)): 
    ?>
    <h3><?=$affiche?></h3>
    <?php
    else:
        foreach($datas as $fifa):
    ?>
    <p><strong><?=$fifa['nom']?></strong> <?=perMillion($fifa['population'])?> d' Habitants</p>
    <?php
        endforeach;
    endif;
    ?>
</body>
</html>