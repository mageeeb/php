
<?php

require_once "../config.php";

try {
    $db = mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME, DB_PORT);
    mysqli_set_charset($db, DB_CHARSET);

} catch (Exception $e) {
    exit (mb_check_encoding($e->getMessage()));
}



if (isset($_POST['nomadresses'], $_POST['mailadresses'])) {
    $nom = htmlspecialchars(strip_tags(trim($_POST['nomadresses'])), ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['mailadresses'])), ENT_QUOTES);

    if(!empty($nom) && !empty($mail)) {
        $sql = "INSERT INTO adresses (nomadresses , mailadresses) VALUE ( '$nom' , '$mail');";
        mysqli_query($db,$sql) or die (mysqli_error($db));
    } 
    elseif (isset($_GET['index'])) {

    }
    $sql= "SELECT nomadresses, mailadresses FROM adresses ORDER BY dateadresses DESC;";
    $result= mysqli_query($db , $sql) or die ("Pas encore d'Adresses");
    $total = mysqli_num_rows($result);
  
}
include_once "../Vue/indexvue.php";

