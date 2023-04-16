<?php
/*function connectUserByUsername(PDO $db, string $uname, string $pwd) :bool|string {

    // sql, on prend l'utilisateur si il existe même si son mot de passe ne correspond pas
    $sql = "SELECT * FROM user WHERE login_user = ?";
    $pwd= "";
    $prepare = $db->prepare($sql);
    try{
        $prepare->execute([$uname]);
    }catch(Exception $e){
        die($e->getMessage());
    }
    // si on a un user
    if($prepare->rowCount()==1){
        $response = $prepare->fetch(PDO::FETCH_ASSOC);
        // on vérifie si le mot de passe crypté dans la DB correspond à celui entré par l'utilisateur
        if(password_verify($pwd,$response['pwd_user'])){
            // création d'une session valide
            // remplissage de la variable de session avec le contenu de la requête
            $_SESSION = $response;
            // suppression de 2 variables inutiles
           // unset($_SESSION['pwd_user'],$_SESSION['useruniqid']);
            // création de la variable de session
            $_SESSION['myID']=session_id();

            return true;

        }else{
            return "Login et/ou mot de passe incorrecte 2";
        }
    }else{
        return "Login et/ou mot de passe incorrecte 1";
    }

}*/


function connectUser(PDO $db){
  if(isset($_POST["envoi"])){
    if(!empty($_POST["login_user"])AND !empty($_POST["pwd_user"])){
      $name = htmlspecialchars($_POST["login_user"]);

      $recupUser = $db->prepare("SELECT * FROM user WHERE login_user = ? AND pwd_user = ?");
      $recupUser->execute(array($name));
    }else{
      echo "veuillez complété le champ...";
      
    }
  } 
}

