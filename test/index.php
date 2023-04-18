<?php
require_once "config.php";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=test', "root", "");
   
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}