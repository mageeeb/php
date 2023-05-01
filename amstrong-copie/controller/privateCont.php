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
} if(isset($_GET['createPost'])){

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

// on veut modifier un Post   
}elseif(isset($_GET['updatePost'])&&ctype_digit($_GET['updatePost'])){

    // si on a envoyé le formulaire de modification
    if(isset($_POST['title'])){
        // pas de vérification des variables $_POST au niveau du contrôleur !!! -> TOUTES LES Vérification doivent se trouver dans la fonction ! 
        $post = postAdminUpdate($connectPDO,$_POST); 
        // si le retour est une chaîne de caractère
        if(is_string($post)){
            // affichage de l'erreur
            $message = $post;
        }
        // dans changements ont été effectués
        if($post===true){
            $message = "L'article a bien été modifié<script>
            setTimeout(\"location.href = './';\", 2000);
             </script>";
        }
    }

    $idUpdatePost = (int) $_GET['updatePost'];

    // chargement de l'article
    # one article by id
    $recupPost = postOneById($connectPDO,$idUpdatePost);

    if(is_bool($recupPost)){
        # récupération du menu pour l'erreur 404
        $recupMenu = getAllCategoryMenu($connectPDO);
        // création de l'erreur pour la 404
        $error = "Cet article n'existe plus";
        // appel de la vue 404
        include_once "../view/publicView/404View.php";
       
    // on a trouvé l'article    
    }else{

    // Appel des catégories pour le multi-choix dans le formulaire
    $categoryChoice = getAllCategoryMenu($connectPDO);

    // Appel des utilisateurs
    $userChoice = getAllUsers($connectPDO);

    // appel de la vue pour insertion
    include "../view/privateView/privateUpdateView.php";
}
  }

