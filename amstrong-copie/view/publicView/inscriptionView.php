<?php
include_once '../view/include/header.php';
?>

    <div class="container">
        <form action="" class="col-md-6">
            <h1>créer un compte</h1>
            <div class="form-group">
                <input type="text" name="pseudo" id="" class="form-control" placeholder="Entrer votre pseudo">
            </div>
            <div class="form-group">
                <input type="text" name="password" id="" class="form-control" placeholder="Entrer votre password">
            </div>
            <div class="form-group">
                <input type="text" name="confirmPassword" id="" class="form-control" placeholder="Veuillez confirmer votre password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="role" id="" class="form-check-input">
                <label for="role">Je souhaite devenir membre</label>
            </div>
            <div class="form-group">
                <a href="?p=connect" class="btn btn-warning">connexion</a>
                <input type="submit" value="créer mon compte" class="btn btn-primary">
            </div>
        </form>
    </div>
    <?php
   include_once '../view/include/footer.php';
    ?>
</body>
</html>