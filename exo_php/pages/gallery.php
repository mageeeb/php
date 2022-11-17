<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Galerie</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <div class="baniere">
        <img src="/img/senegal.jpg" alt="img">
        <div class="text">
            <h1>Voyage au Sénégal</h1>
        </div>
    </div>
    <?php
    include "menu.php";
    ?>
    <div class="gal">
        <h1 class="titre">Bienvenue sur la Galeries</h1>
        <img src="" alt="">
    </div>

    <table>
        <tr>
            <td><a href="../img/1280px_Acropole_Caryatides.jpg" data-lightbox="mes_photos"><img alt="Photo1" src="../img/480px_Acropole_Caryatides.jpg"></a></td>
            <td><a href="../img/1280px_Attica_Athens_View_from_Acropolis_Hill.jpg" data-lightbox="mes_photos"><img alt="Photo2" src="../img/480px_Attica_Athens_View_from_Acropolis_Hill.jpg"></a></td>
            <td><a href="../img/1280px_monument.jpg" data-lightbox="mes_photos"><img alt="Photo2" src="../img/480px_monument.jpg"></a></td>
        </tr>
        <tr>
            <td><a href="../img/1280px_Odeon_of_Herodes_Atticus.jpg" data-lightbox="mes_photos"></a><img alt="Photo3" src="../img/480px_Odeon_of_Herodes_Atticus.jpg"></a></td>
            <td><a href="../img/1280px_Temple_of_Zeus_in_Athens.jpg" data-lightbox="mes_photos"></a><img alt="Photo4" src="../img/480px_Temple_of_Zeus_in_Athens.jpg"></a></td>
            <td><a href="../img/1280px_View_of_the_Acropolis_Athens.jpg" data-lightbox="mes_photos"><img alt="Photo2" src="../img/480px_View_of_the_Acropolis_Athens.jpg"></a></td>
        </tr>
    </table>
    <script src="lightbox/lightbox-plus-jquery.min.js"></script>

</body>

</html>