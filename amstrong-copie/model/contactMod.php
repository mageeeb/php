<?php

function inscriptionUser(PDO $db){
    if(isset($_POST['envoi'])){
        if(!empty($_POST['pseudo']) and !empty($_POST['pwd'])){
            $pseudo= htmlspecialchars($_POST['pseudo']);
            $mdp = sha1($_POST['pwd']);
            $insertInscrip = $db->prepare('INSERT INTO user(login_user, pwd_user) VALUES (?,?) ');
            $insertInscrip->bindValue('user', $pseudo, $mdp , PDO::PARAM_INT);
            $insertInscrip ->execute(array($pseudo,$mdp));
            
    
        }else{
            echo 'veuillez compléter tout les champs...';
        }
    }
    }
?>