<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    const DB_HOST = "localhost";
    const DB_LOGIN = "root";
    const DB_PWD = "";
    const DB_NAME = "connexion";
    const DB_PORT = 3307;
    const DB_CHARSET = "utf8mb4";

    $dbConnect = "mysql:dbname=".DB_NAME.";host=".DB_HOST;

    try{
        $db= new PDO($dbConnect, DB_LOGIN, DB_PWD);
        echo "tu es connecté";
    }catch(PDOException $e){
        die($e->getMessage());
    }
?>
</body>
</html>

