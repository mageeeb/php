<?php
 require_once(dirname(__FILE__)."/../config.php");
function utilisateur(PDO $db){
    $req = $db->prepare("SELECT * FROM user WHERE pseudo = :login_user AND password = :pwd_user");
   $req->bindParam(":login_user", $_POST["pseudo"]);
   $req->bindParam(":pwd_user", $_POST["password"]);
   $req->execute();
       
  
}
   
     
      
   
