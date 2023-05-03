<?php

//  Pouvoir insérer un article AVEC ses catégories, AVEC une transaction
function postAdminInsert(PDO $db, int $idUser, string $title, string $content, array $idCateg=[]):bool{
    // début de transaction, arrête les autocommit, il faut appeler $db->commit() pour que toutes les requêtes soient effectivement validées
    $db->beginTransaction();
    // requêtes préparées contre les injections SQL (! au tableau $idCateg, on peut falsifier son contenu)
    $preparePost = $db->prepare("INSERT INTO `post` (`title`,`content`,`user_id`) VALUES (:title, :content, :iduser)");

    $preparePost->bindValue(":iduser", $idUser, PDO::PARAM_INT);
    $preparePost->bindValue(":title", $title, PDO::PARAM_STR);
    $preparePost->bindValue(":content", $content, PDO::PARAM_STR);

    // insertion du Post

    $preparePost->execute();

    // récupération immédiate de l'id inséré par la connexion de l'utilisateur actuel (table Post)
    $postLastInsertId = $db->lastInsertId();


    // pour insérer les catégories dans la table M2M, on ne garde que les valeurs qui doivent être des integer dans des champs category_has_post

    // si le tableau n'est pas vide (catégories potentielles)
if(!empty($idCateg)){

    // requête préparée
    $prepareCategory_has_post = $db->prepare("INSERT INTO `category_has_post` (`category_id`,`post_id`) VALUES (:idcateg, :idpost)");
    // $valeur par défaut (sera remplacée en cas de validité du tableau)
    $categId = 100;

    // attribution des valeurs par référence, $value est donc une valeur par défaut qui ne sera pas utilisée
    $prepareCategory_has_post->bindParam("idpost",$postLastInsertId,PDO::PARAM_INT);
    $prepareCategory_has_post->bindParam("idcateg",$categId,PDO::PARAM_INT);

    foreach ($idCateg as $value) {
        if(ctype_digit($value)){
            $categId = (int) $value;
            $prepareCategory_has_post->execute();
        }
    }

}

    try{
        // on essaye d'envoyer toutes nos requêtes à la DB
        $db->commit();
        return true;
    }catch(Exception $e){
        // si une erreur dans au moins 1 requête
        // on les annule toutes
        $db->rollBack();
        die($e->getMessage());
    }

}