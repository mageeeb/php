<?php
// public homepage function All Posts
function postHomepageAll(mysqli $db): array{
    $sql = "SELECT p.id, p.title, LEFT(p.content, 255) AS contentshort, p.datecreate, u.id AS iduser, u.userscreen, 
    GROUP_CONCAT(c.id) AS idcategory, 
    GROUP_CONCAT(c.title SEPARATOR '||0||') AS titlecategory
    FROM post p
        INNER JOIN user u
            ON p.user_id = u.id
        LEFT JOIN category_has_post h 
            ON p.id = h.post_id
        LEFT JOIN category c 
            ON c.id = h.category_id
        #WHERE p.id =77
            GROUP BY p.id
    ORDER BY p.datecreate DESC;";

    try{
        $query = mysqli_query($db,$sql);
    }catch(Exception $e){
        die($e->getMessage());
    }
    return mysqli_fetch_all($query,MYSQLI_ASSOC);
}

// public detail Post by id
function postOneById(mysqli $db, int $id): array|null{
    // si mauvais format : 0
    $id = (int) $id;

    $sql = "SELECT p.id, p.title, p.content, p.datecreate, 
    u.id AS iduser, u.userscreen, 
    GROUP_CONCAT(c.id) AS idcategory, 
    GROUP_CONCAT(c.title SEPARATOR '||0||') AS titlecategory
    FROM post p
        INNER JOIN user u
            ON p.user_id = u.id
        LEFT JOIN category_has_post h 
            ON p.id = h.post_id
        LEFT JOIN category c 
            ON c.id = h.category_id
        WHERE p.id = $id
            GROUP BY p.id;";

    try{
        $query = mysqli_query($db,$sql);
    }catch(Exception $e){
        die($e->getMessage());
    }
    return mysqli_fetch_assoc($query);
}

// public post by category id
function postByCategoryId(mysqli $db,int $idcateg): array{
    $sql = "SELECT p.id, p.title, LEFT(p.content, 255) AS contentshort, p.datecreate, u.id AS iduser, u.userscreen, 
    GROUP_CONCAT(c2.id) AS idcategory, 
    GROUP_CONCAT(c2.title SEPARATOR '||0||') AS titlecategory
    FROM post p
        INNER JOIN user u
            ON p.user_id = u.id
        LEFT JOIN category_has_post h 
            ON p.id = h.post_id
        LEFT JOIN category c 
            ON c.id = h.category_id
        /* ici l'alias est très utile, il permet d'ajouter les catégories en évitant le blocage de l'autre jointure car WHERE c.id = $idcateg, c2.id est comme venant d'une autre table */    
        LEFT JOIN category_has_post h2 
            ON p.id = h2.post_id
        LEFT JOIN category c2 
            ON c2.id = h2.category_id
        WHERE c.id = $idcateg
            GROUP BY p.id
    ORDER BY p.datecreate DESC;";

    try{
        $query = mysqli_query($db,$sql);
    }catch(Exception $e){
        die($e->getMessage());
    }
    return mysqli_fetch_all($query,MYSQLI_ASSOC);
}

// public post by user id
function postByUserId(mysqli $db,int $iduser): array{
    $sql = "SELECT p.id, p.title, LEFT(p.content, 255) AS contentshort, p.datecreate, u.id AS iduser, u.userscreen, 
    GROUP_CONCAT(c.id) AS idcategory, 
    GROUP_CONCAT(c.title SEPARATOR '||0||') AS titlecategory
    FROM post p
        INNER JOIN user u
            ON p.user_id = u.id
        LEFT JOIN category_has_post h 
            ON p.id = h.post_id
        LEFT JOIN category c 
            ON c.id = h.category_id
       
        WHERE u.id = $iduser
            GROUP BY p.id
    ORDER BY p.datecreate DESC;";

    try{
        $query = mysqli_query($db,$sql);
    }catch(Exception $e){
        die($e->getMessage());
    }
    return mysqli_fetch_all($query,MYSQLI_ASSOC);
}

// cut the text
    function trunCate (string $text): string{
    // fonction qui trouve un numérique qui est la dernière sous chaine dans une chaine pour remplacer $cut : " "
    $cut = strrpos($text, ' ');
    return substr ($text, 0,$cut);
}
// date fr
  // Convertit une date ou un timestamp en français//
  function dateToFrench(string $date, string $format="l j F Y \à h \h i "): string{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );}
