<?php

require_once "../config.php";


try{
    
    $db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    
    mysqli_set_charset($db, DB_CHARSET);
    
}catch(Exception $e){

    exit(mb_convert_encoding($e->getMessage(),'UTF-8','ISO-8859-1'));

}

if(isset($_POST['nomadresses'], $_POST['mailadresses'])){

    $nom = htmlspecialchars(strip_tags(trim($_POST['nomadresses'])),ENT_QUOTES);
    $mail = htmlspecialchars(strip_tags(trim($_POST['mailadresses'])),ENT_QUOTES);

    if(!empty($nom)&&!empty($mail)){
        
        $sql = "INSERT INTO adresses (nomadresses,mailadresses) VALUES ('$nom','$mail');";
        mysqli_query($db,$sql) or die (mysqli_error($db));
        
        //header("Location: ./");
    }

    $sql = "SELECT nomadresses , mailadresses FROM adresses
    ORDER BY dateadresses DESC;";    
    $query = mysqli_query($db, $sql) or die('Erreur de $query');    
    $resultatRubriques = mysqli_fetch_all($query,);

} elseif (isset($_GET['index'])) {

    // Code pour récupérer une entrée de la DB ICI
}

include_once "../view/indexView.php";