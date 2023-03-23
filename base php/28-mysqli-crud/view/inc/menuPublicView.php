<nav class="inline-block;">
        <a href="./">Accueil</a>
        <?php
        foreach($resultatRubriques AS $item):
        ?>
        <a href="?section=<?=$item['idrubriques']?>"><?=$item['rub_title']?></a>
        <?php
        endforeach;
        ?>
        <a href="?admin">Admin</a>
    </nav>