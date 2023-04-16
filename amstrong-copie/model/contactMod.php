<?php

function inscriptionUser(PDO $db){
    if(isset($_POST['envoi'])){
        if(!empty($_POST['login_user']) and !empty($_POST['pwd_user'])){
            $pseudo= htmlspecialchars($_POST['login_user']);
            $mdp = sha1($_POST['pwd_user']);
            $insertInscrip = $db->prepare('INSERT INTO user(login_user, pwd_user) VALUES (?,?) ');
            $insertInscrip->bindValue('user', $pseudo, $mdp , PDO::PARAM_INT);
            $insertInscrip ->execute(array($pseudo,$mdp));
            
    
        }else{
            echo 'veuillez compléter tout les champs...';
        }
    }
    }
?>