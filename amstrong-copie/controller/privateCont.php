<?php 

$allArticle = getAllArticle($db);

if(isset($_GET['deconnect'])){
    if(deconnect()){
        header("location: ./");
    }       
}

if(isset($_GET['p'])){
    if($_GET['p']==="article_id"){
        
    }elseif(isset($_GET['article_delete'])&&ctype_digit($_GET['article_delete'])){
        
        $postId = (int) $_GET['article_delete'];
        
        if(postAdminDeleteById($db,$postId)){
            header("Location: ./?m=L'article dont l'id est $postId a été supprimé");
            exit();
        }else{
            header("Location: ./?m=Problème lors de la modification de l'article!");
            exit();
        }
        echo 'delete';
    }elseif($_GET['p']==="article_update"){
        
        echo 'update';
    }elseif($_GET['p']==="article_add"){
        
        include_once '../view/privateView/addArticleView.php';
    }else{
        
        include_once '../view/privateView/crudAdmin.php';  
    }
    
}

elseif(isset($_GET['article_update']) && ctype_digit($_GET['article_update'])){
    $articleUpdateId = (int) $_GET['article_update']; 
    $articleById = getArticleById($db, $articleUpdateId);
    $allCategory = getCategoryMenu($db);
    $imageByArticleId = getImageByarticleId($db, $articleUpdateId);
    include_once '../view/privateView/updateArticleView.php';
}

else{
    if(isset($_SESSION) && $_SESSION['permission_user']===0){

        include_once '../view/privateView/crudAdmin.php';
    }else{
        $articleByUser = getArticleByUserId($db, $_SESSION['id_user']);
        include_once '../view/privateView/crudUser.php';
    }
}

// on a cliqué sur créer un article

if(isset($_GET['p'])&&$_GET['p']=="article_add"){

    // si on a envoyé le formulaire (toutes les variables POST attendues existent)
    if(isset($_POST['name_article_add'],$_POST['min_description_article'],$_POST['max_description_article'],$_POST['sound_article_add'])){

        //var_dump($_POST);
        //exit();

        // traitement des variables
        $titre= htmlspecialchars(strip_tags(trim($_POST['name_article_add'])),ENT_QUOTES);
        // exception pour le strip_tags qui va accepter
        $texteMin= htmlspecialchars(strip_tags(trim($_POST['min_description_article']),'<p><br><a><img><h4><h5><b><strong><i><ul><li>'),ENT_QUOTES);
        $texteMax= htmlspecialchars(strip_tags(trim($_POST['max_description_article']),'<p><br><a><img><h4><h5><b><strong><i><ul><li>'),ENT_QUOTES);
        $urlSound= htmlspecialchars(strip_tags(trim($_POST['sound_article_add']),'<p><br><a><img><h4><h5><b><strong><i><ul><li>'),ENT_QUOTES);
        //$idusers = (int) $_POST['idusers'];

        // si un des champs est vide (n'a pas réussi la validation des variables POST)
        if(empty($titre)||empty($texteMin)||empty($texteMax) ||empty($urlSound)){
            $erreur = "Format des champs non valides";
        }else{
            // insertion d'article avec récupération de son id
            $insert = insertArticle($db,$titre,$texteMin,$texteMax,$urlSound);

            // insertion réussie (un id et pas false)
            if($insert){

                // si on a coché au moins une rubrique (existence de idrubriques)
                if(isset($_POST['id_category'])){

                    insertLinkArticlesWithRubriques($db,$insert,$_POST['id_category']);

                }


                // si on veut y ajouter une image
                if(!empty($_FILES['theimages_name'])){
                    $upload = getImageByarticleId($_FILES['theimages_name'],IMG_FORMAT,IMG_MAX_SIZE,IMG_UPLOAD_ORIGINAL,IMG_UPLOAD_MEDIUM,IMG_UPLOAD_SMALL,IMG_MEDIUM_WIDTH,IMG_MEDIUM_HEIGHT,IMG_SMALL_WIDTH,IMG_SMALL_HEIGHT,IMG_JPG_MEDIUM,IMG_JPG_SMALL);

                    // l'image a bien été envoyée, donc on obtient un tableau
                    if(is_array($upload)){
                        // on insert l'image (et on récupère l'id de l'image)
                        $idtheimages = getImageByarticleId($db,$_POST['theimages_title'],$upload[0],$insert);

                    // en cas d'erreur (string)
                    }else{
                        $error = $upload;
                    }
                }
                header("Location: ./");
                exit;
            }else{

                $erreur ="Problème lors de l'insertion";
            }

        }
    }

    // on récupère tous les auteurs potentiels
    //$recup_autors = getArticleByUserId($db,$id);
    // on récupère toutes les rubriques potentielles
    $recup_categs = getAllArticle($db);

    require_once "../view/privateView/addArticleView.php";
    //var_dump($_POST);
    exit();
}