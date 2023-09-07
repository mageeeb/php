<?php
session_start();
require_once '../config.php';
require_once '../model/articleMod.php';
require_once '../model/connectionMod.php';
require_once '../model/contactMod.php';
require_once '../model/categoryModel.php';


try {

    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);


    if (ENV == "dev" || ENV == "test") {

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch (Exception $e) {

    die($e->getMessage());
}


if (isset($_SESSION['myID']) && $_SESSION['myID'] == session_id()) {
    include_once '../controller/privateCont.php';
} else {
    include_once '../controller/publicCont.php';
}
