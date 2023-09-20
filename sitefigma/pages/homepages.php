<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Site de Figma</title>
</head>

<body>

    <header class="header">
        <div class="div">
            <img src="./images/logo Bronks.png" alt="logo">
        </div>
        <div class="images">
            <?php
            include "menu.php"
            ?>
            <div class="image">
                <a href="/pages/comeonefit.php"> <img src="./images/photos home/Rectangle 4.png" alt=""></a>
                <a href="/pages/studiobronz.php"> <img src="./images/photos home/Rectangle 5.png" alt=""></a>
                <a href="/pages/ecole.php"><img src="/images./photos home/Rectangle 6.png" alt=""></a>
                <a href="/pages/openhuiz.php"> <img src="./images/photos home/Rectangle 7.png" alt=""></a>
                <a href="/pages/propos_de_bronz.php"> <img src="./images/photos home/Rectangle 8.png" alt=""></a>
                <a href="/pages/votre_visite.php"> <img src="./images/photos home/Rectangle 9.png" alt=""></a>
            </div>
        </div>
        <?php
        include "footer.php"
        ?>

    </header>



</html>