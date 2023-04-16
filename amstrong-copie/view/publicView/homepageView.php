<?php 

$title = "accueil";
include_once '../view/include/header.php';

// var_dump($allArticle);

foreach($allArticle as $item):
?>

<h2><?= $item['name_article']; ?> (<?= $item['id_article'];?>)</h2>
<img src="<?= $item['url']; ?>" alt="" width="300px">
<p><?= $item['sound_article']; ?></p>
<p><?= $item['min-description_article']; ?></p>
<p><?= $item['date_article']; ?></p> by <p><?= $item['login_user']; ?></p>
<hr>
<?php endforeach;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>coucou</h1>
</body>
</html>