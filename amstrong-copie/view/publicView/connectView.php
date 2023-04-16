
<?php
var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Connexion à l'administration :  </h3>
                    <form method="POST" action="" name="Connexion">
  <div class="mb-3">
    <?php
      if(isset($message)):
    ?>
<button type="button" class="btn btn-warning"><?=$message?></button><br>
    <?php
      endif;
    ?>
    <label for="" >Username</label>
    <input name="login_user" type="text"  id="" aria-describedby="email" required>
    <div id="" class="form-text">username</div>
  </div>
  <div >
    <label for="" >Password</label>
    <input name="pwd_user" type="password"  id="" required>
  </div>

  <button type="submit" name="envoi" >Submit</button>
</form>


                    <a href="./">Retour sur notre site !</a>
              
                

</div>
</body>
</html>