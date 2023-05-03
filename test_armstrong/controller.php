<?php

if(isset($_GET['createPost'])){

    // si on a envoyé le formulaire d'insertion
    if(isset($_POST['title'],$_POST['content'],$_POST['user_id'])){
        $UserId = (int) $_POST['user_id']; // si erreur => 0
        $postTitle = htmlspecialchars(strip_tags(trim($_POST['title'])),ENT_QUOTES);
        $postContent = htmlspecialchars(strip_tags(trim($_POST['content'])),ENT_QUOTES);
        // ternaire ! si tableau les valeurs et clefs ne sont pas protégée contre une manipulation externe (injection etc...)
        $idCateg = (isset($_POST['category_id'])&&is_array($_POST['category_id']))? $_POST['category_id'] : [];

    if(!empty($UserId)&&!empty($postTitle)&&!empty($postContent)) {
        //  Pouvoir insérer un article AVEC ses catégories
        $insert = postAdminInsert($connectPDO, $UserId, $postTitle, $postContent, $idCateg);
        if($insert===true){
            $message = "Article inséré dans la DB";
        }
    }
    }

    // Appel des catégories pour le multi-choix dans le formulaire
    $categoryChoice = getAllCategoryMenu($connectPDO);

    // Appel des utilisateurs
    $userChoice = getAllUsers($connectPDO);

    // appel de la vue pour insertion
    include "../view/privateView/privateInsertView.php";

}