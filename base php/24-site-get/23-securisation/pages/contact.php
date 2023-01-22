<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <h1>Contact</h1>
    <nav>
        <a href="./">Accueil</a> <a href="?page=calculatrice">calculatrice</a> <a href="?page=contact">Contact</a>
    </nav>
    <p>Ce fichier représente une vue, il contient l'html</p>
    <p>Le fichier index va chercher config.php et functions.php (modèle), ce qui permet l'affichage de ces calculs</p>
    <?php
echo calculBasicWithInstruction(25,17);
echo "<hr>";
echo calculBasicWithInstruction(25,17,"-");
echo "<hr>";
echo calculBasicWithInstruction(25,17,"*");
echo "<hr>";
echo calculBasicWithInstruction(25,17,"++");
echo "<hr>";
echo calculBasicWithInstruction(25,0,"/");
echo "<hr>";
echo calculBasicWithInstruction("blob",17,"/");
echo "<hr>";
?>
</body>
</html>