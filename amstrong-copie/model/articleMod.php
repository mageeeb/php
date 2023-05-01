<?php

// CATEGORY :
function getCategoryMenu(PDO $db): array {
    $sql ="SELECT id_category, name_category FROM category ORDER BY id_category ASC";
    try{
        $query=$db->query($sql);
    }catch(Exception $e){
        die($e->getMessage());
    }
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// ARTICLES :

function getAllArticle(PDO $db): array{
    $sql = "SELECT `id_article`, `name_article`, `min_description_article`, `date_article`, `sound_article`, `wiki_article`, `nb_click`, `user_id_user`, `login_user`, `url`, `name_category`, `id_category`   
    FROM `article` 
    JOIN user ON article.user_id_user = user.id_user 
    JOIN image ON image.article_id_article = article.id_article 
    JOIN category_has_article h ON h.article_id_article = article.id_article 
    JOIN category c ON h.category_id_category = c.id_category 
    WHERE image.position = 1
    ORDER BY `id_article` ASC";

    try{
        $query = $db->query($sql);
    }catch(Exception $e){
        die($e->getMessage());
    }
    
    $bp = $query->fetchAll(PDO::FETCH_ASSOC);
    $query->closeCursor();
    return $bp;
}

function getCategoryById(PDO $db, $id):array|bool{
    $sql = "SELECT * FROM category where id_category=?";
    $prepare = $db -> prepare($sql);
    try{
        $prepare->execute([$id]);
    }catch(Exception $e){
        die($e->getMessage());
    }
    $bp = $prepare->fetch(PDO::FETCH_ASSOC);
    $prepare->closeCursor();
    return $bp;
}

function getArticleByCategory(PDO $db, $id){
    $sql = "SELECT a.id_article, a.name_article, a.sound_article, a.min_description_article, c.name_category, i.url 
    FROM article a 
    JOIN image i ON i.article_id_article = a.id_article
    JOIN category_has_article h ON h.article_id_article = a.id_article 
    JOIN category c ON h.category_id_category = c.id_category 
    WHERE c.id_category = :id AND i.position = 1;";

    $prepare = $db->prepare($sql);
    $prepare->bindValue(':id',$id,PDO::PARAM_INT);
    try{
        $prepare->execute();
    }catch(Exception $e){
        die($e->getMessage());
    }
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    $prepare->closeCursor();
    return $result;
}


// recupere les articles avec l'id
function getArticleById($db, $id){
    $sql = "SELECT a.id_article, a.name_article, a.min_description_article, a.max_description_article, a.sound_article, .a.date_article, a.wiki_article, u.login_user, c.name_category, c.id_category 
    FROM `article` a 
    JOIN category_has_article h ON h.article_id_article = a.id_article 
    JOIN category c ON h.category_id_category = c.id_category 
    JOIN user u
    ON a.user_id_user = u.id_user
    WHERE id_article = :id;";

    $prepare = $db->prepare($sql);
    $prepare->bindValue(':id',$id,PDO::PARAM_INT);
    try{
        $prepare->execute();
    }catch(Exception $e){
        die($e->getMessage());
    }
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    $prepare->closeCursor();
    return $result;
}
//  et recupere les images avec l'ic correspondant
function getImageByarticleId($db, $id){
    $sql = "SELECT * FROM `image` WHERE article_id_article = :id;";

    $prepare = $db->prepare($sql);
    $prepare->bindValue(':id',$id,PDO::PARAM_INT);
    try{
        $prepare->execute();
    }catch(Exception $e){
        die($e->getMessage());
    }
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    $prepare->closeCursor();
    return $result;
}

// pour splitter la description en 3 paragraphes
function breakText($text, $minLength, $needle='.') {
    $delimiter = preg_quote($needle);
    $match = preg_match_all("/.*?$delimiter/",$text, $matches);

    if ($match == 0)
        return array($text);

    $sentences = current($matches);
    $paras = array();
    $tmp = '';

    foreach ($sentences as $sentence) {
        $tmp .= $sentence;
        if (strlen($tmp) > $minLength){
            $paras[] = $tmp;
            $tmp = '';
        }
    }

    if ($tmp != '')
    $paras[] = $tmp;
    return $paras;
}

//suprimer un post
function postAdminDeleteById(PDO $db, int $id): bool
{
    // pour utiliser l'exec plutôt que le prepare/execute, mauvaise pratique
    $sql = "DELETE FROM `article` WHERE id_article=$id";

    try {
        // envoie 1 en cas de réussite (nb de lignes affectées par exec), 0 en cas d'échec -> true ou false
        $exec = $db->exec($sql);
        return true;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

function getArticleByUserId(PDO $db, $userId){
    $sql = "SELECT `id_article`, `name_article`, `min_description_article`, `date_article`, `sound_article`, `wiki_article`, `nb_click`, `user_id_user`, `login_user`, `url`, `name_category`, `id_category`   
    FROM `article` 
    JOIN image ON image.article_id_article = article.id_article 
    JOIN category_has_article h ON h.article_id_article = article.id_article 
    JOIN category c ON h.category_id_category = c.id_category 
    JOIN user ON article.user_id_user = user.id_user 
    WHERE  user_id_user = $userId
    ORDER BY `id_article` ASC";

    try{
        $query = $db->query($sql);
    }catch(Exception $e){
        die($e->getMessage());
    }
    
    $bp = $query->fetchAll(PDO::FETCH_ASSOC);
    $query->closeCursor();
    return $bp;
}

//insertion article vec categ
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