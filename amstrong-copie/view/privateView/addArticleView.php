<?php

$title = "ajout d'article";
include_once '../view/include/header.php';
var_dump($allArticle);
?>

<!-- <style> et <hr> à enlever quand il faudra styliser -->
<style>
    form input, form textarea {
        display: block;
        margin: 0.5rem;
    }
</style>

<h2>Salut <?= $_SESSION['login_user']?></h2>

<!--<form action="" method="POST">
    <input type="text" placeholder="nom de l'instrument" name="name_article_add">
    <textarea name="min_description_article" id="" cols="30" rows="10" placeholder="une courte introduction de votre article"></textarea>
    <textarea name="max_description_article" id="" cols="30" rows="10" placeholder="votre texte"></textarea>
    <input type="text" placeholder="extrait sonore mp3 (url)" name="sound_article_add">
    <input type="text" placeholder="URL photo 1 (obligatoire)" name="url_image_add_1">
    <input type="text" placeholder="URL photo 2 (optionnelle)" name="url_image_add_2">
    <input type="text" placeholder="URL photo 3 (optionnelle)" name="url_image_add_3">
        <hr>
    <p>Choisissez une ou plusieurs catégorie(s)</p>
    <input type="checkbox" name="perce cylindrique" id="perce cylindrique">
    <label for="perce cylindrique">perce cylindrique</label>
        <hr>
    <input type="checkbox" name="perce conique" id="perce conique">
    <label for="perce conique">perce conique</label>
        <hr>
    <input type="checkbox" name="perce hybride" id="perce hybride">
    <label for="perce hybride">perce cylindrique</label>
    <input type="submit" value="envois">

</form>-->
<form action="" enctype="multipart/form-data"  name="insertion" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Votre titre :</label>
                        <input name="name_article_add" type="text" class="form-control" placeholder="Votre titre" required>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">une courte introduction de votre article</label>
                        <textarea name="min_description_article" id="" cols="30" rows="10" placeholder="une courte introduction de votre article"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Votre texte</label>
                        <textarea name="max_description_article" id="" cols="30" rows="20" placeholder="votre texte"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Votre sound</label>
                        <input type="text" placeholder="extrait sonore mp3 (url)" name="sound_article_add">
                    </div>
                    
                    <div class="form-group">
                    <p>Choisissez une ou plusieurs catégorie(s)</p>
    <input type="checkbox" name="perce cylindrique" id="perce cylindrique">
    <label for="perce cylindrique">perce cylindrique</label>
        <hr>
    <input type="checkbox" name="perce conique" id="perce conique">
    <label for="perce conique">perce conique</label>
        <hr>
    <input type="checkbox" name="perce hybride" id="perce hybride">
    <label for="perce hybride">perce cylindrique</label>
    <input type="submit" value="envois">
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>

            <hr>
                    <h3>Ajouter des images</h3>
                <div class="form-group">
                    <label=>Votre image :</label>
                    <input name="theimages_name" type="file" class="form-control" placeholder="Votre image" >
                </div>
                <div class="form-group">
                    <label=>Votre image :</label>
                    <input name="theimages_name" type="file" class="form-control" placeholder="Votre image" >
                </div>
                <div class="form-group">
                    <label=>Votre image :</label>
                    <input name="theimages_name" type="file" class="form-control" placeholder="Votre image" >
                </div>
            </form>
            </div>
        </div>
    </div>