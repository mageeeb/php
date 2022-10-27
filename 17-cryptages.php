<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crytpages</title>
</head>
<body>
    <h1>Cryptages</h1>
    <h2>Les cryptages non inversables</h2>
    <h3>Ne jamais utiliser un site externe pour créer vous mots de passe !</h3>
    <form action="" method="post" name="pwd">
        <input type="password" name="aPassword" required /><br>
        <input type="submit" value="envoyer"/>
    </form>
    <?php
    var_dump($_POST);
    if(isset($_POST['aPassword'])):
    ?>
    <h2>MD5</h2>
    <p>à ne plus utiliser, trop rapide et donc peu sécurisé (déjà cassé)</p>
    <p><?php
    echo md5($_POST['aPassword'])
    ?></p>
    <h2>SHA-1 (128 bit)</h2>
    <p>à ne plus utiliser, car déjà cassé, même si c'est de manière anecdotique</p>
    <p><?php
    echo sha1($_POST['aPassword'])
    ?></p>
    <h2>SHA-2 (256 bit)</h2>
    <p>On peut l'utiliser, ici avec la fonction hash()</p>
    <p><?php
    echo hash('sha256',$_POST['aPassword']);
    ?></p>
    <h2>Recommandé : password_hash() et password_verify()</h2>
    <p>On va l'utiliser pour la gestion de nos mots de passe, sans lui donner d'algorythme par défaut</p>
    <p><?php
    $pwdHash = password_hash($_POST['aPassword'],PASSWORD_DEFAULT);
    echo $pwdHash;
    echo "<hr>";
    if(password_verify($_POST['aPassword'],$pwdHash)){
        echo "Bon mot de passe";
    }else{
        echo "Mot de passe incorrecte";
    }
    echo "<hr>";
    if(password_verify($_POST['aPassword'],$pwdHash."5")){
        echo "Bon mot de passe";
    }else{
        echo "Mot de passe incorrecte";
    }
    ?></p>
    <?php
    endif;
    ?>
</body>
</html>