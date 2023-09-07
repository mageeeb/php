<?php

$allArticle = getAllArticle($db);
//modif
$allCateg = getCategoryMenu($db);
//---------
if (isset($_GET['deconnect'])) {
    if (deconnect()) {
        header("location: ./");
    }
}
if (isset($_GET['p'])) {
    if ($_GET['p'] === "article_id") {
    } elseif (isset($_GET['article_delete']) && ctype_digit($_GET['article_delete'])) {

        $postId = (int) $_GET['article_delete'];

        if (postAdminDeleteById($db, $postId)) {
            header("Location: ./?m=L'article dont l'id est $postId a été supprimé");
            exit();
        } else {
            header("Location: ./?m=Problème lors de la modification de l'article!");
            exit();
        }
        echo 'delete';
    } elseif ($_GET['p'] === "article_update") {

        echo 'update';
    } elseif ($_GET['p'] === "article_add") {

        include_once '../view/privateView/addArticleView.php';
    } else {

        include_once '../view/privateView/crudAdmin.php';
    }
} else {
    include_once '../view/privateView/crudAdmin.php';
}
//mofif
if (isset($_POST['submit'])) {
    $postTitle = htmlspecialchars(strip_tags(trim($_POST['name_article'])), ENT_QUOTES);
    $postMin = htmlspecialchars(strip_tags(trim($_POST['min_description_article'])), ENT_QUOTES);
    $postMax = htmlspecialchars(strip_tags(trim($_POST['max_description_article'])), ENT_QUOTES);
    $postSound = htmlspecialchars(strip_tags(trim($_POST['sound_article'])), ENT_QUOTES);
    $postImg1 = htmlspecialchars(strip_tags(trim($_POST['url_image_1'])), ENT_QUOTES);
    $postImg2 = htmlspecialchars(strip_tags(trim($_POST['url_image_2'])), ENT_QUOTES);
    $postImg3 = htmlspecialchars(strip_tags(trim($_POST['url_image_3'])), ENT_QUOTES);
    $idCateg = (isset($_POST['category_id_category']) && is_array($_POST['category_id_category'])) ? $_POST['category_id_category'] : [];

    try {
        postAdminInsert($db, $_SESSION['id_user'], $postTitle, $postMin, $postMax, $postSound, $idCateg);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
//--
