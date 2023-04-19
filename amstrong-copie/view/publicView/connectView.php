<?php
include_once '../view/include/header.php';
?>
<body>

    <div class="container">
        <form action="" class="col-md-6" method="POST">
            <h1>Se connecter</h1>
            <div class="form-group">
                <input type="text" name="pseudo" id="" class="form-control" placeholder="Entrer votre pseudo">
            </div>
            <div class="form-group">
                <input type="text" name="password" id="" class="form-control" placeholder="Entrer votre password">
            </div>

            <div class="form-group">
                <a href="?p=Inscription" class="btn btn-warning">créer un compte</a>
                <input type="submit" value="je me connecte" class="btn btn-primary">
            </div>
        </form>
    </div>

  <?php
 include_once '../view/include/footer.php';
  ?>
</body>

</html>