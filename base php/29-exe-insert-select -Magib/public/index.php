<?php

require_once "../config.php";


try {

    $db = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME, DB_PORT);

    mysqli_set_charset($db, DB_CHARSET);
} catch (Exception $e) {

    exit(mb_convert_encoding($e->getMessage(), 'UTF-8', 'ISO-8859-1'));
}

include_once "../view/indexView.php";

if (isset($_POST['nomadresses'], $_POST['mailadresses'])) {

    $nom = htmlspecialchars(strip_tags(trim($_POST['nomadresses'])), ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['mailadresses'])), ENT_QUOTES);

    if (!empty($nom) && !empty($mail)) {

        $sql = "INSERT INTO adresses (nomadresses,mailadresses) VALUES ('$nom','$mail');";
        mysqli_query($db, $sql) or die(mysqli_error($db));

        //header("Location: ./");
    }
} elseif (isset($_GET['index'])) {

    // Code pour récupérer une entrée de la DB ICI
}

$sql = "SELECT nomadresses , mailadresses FROM adresses
            ORDER BY dateadresses DESC;";
$result = mysqli_query($db, $sql) or die("Pas encore d'adresses");
$total = mysqli_num_rows($result);

if ($total > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo $row['nomadresses'];
        echo "<br>";
        echo $row['mailadresses'];
    }
} else {
    // Erreur plus d'article
    $error = "Pas encore d'adresses";
    echo "$error";
}

