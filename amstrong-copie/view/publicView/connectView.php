
<?php 

$title = "Connect";
include_once '../view/include/header.php';


?>
<form action="" method="POST">
  <label for="login">Nom d'utilisateur :</label>
  <input type="text" id="login" name="login"><br>

  <label for="pwd">Mot de passe :</label>
  <input type="password" id="pwd" name="pwd"><br>


<?php
include_once '../view/include/header.php';
?>
<body>


  <input type="submit" name="connect">
</form>
<button type="button"><a href="?p=sub">Inscrivez vous ici</a></button>


<?php
  if (isset($message)) {
    echo "<h1>$message</h1>";
  }
?>

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

