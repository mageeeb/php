<?php
class User {
    private $db;
    private $username;
    private $password;

    public function __construct(PDO $db, string $uname, string $pwd) {
        $this->db = $db;
        $this->username = $uname;
        $this->password = $pwd;
    }

    public function connect() : bool|string {
        // sql, on prend l'utilisateur si il existe même si son mot de passe ne correspond pas
        $sql = "SELECT * FROM user WHERE username=?";
        $prepare = $this->db->prepare($sql);
        try {
            $prepare->execute([$this->username]);
        } catch(Exception $e) {
            die($e->getMessage());
        }
        // si on a un user
        if($prepare->rowCount() == 1) {
            $response = $prepare->fetch(PDO::FETCH_ASSOC);
            // on vérifie si le mot de passe crypté dans la DB correspond à celui entré par l'utilisateur
            if(password_verify($this->password, $response['userpwd'])) {
                // création d'une session valide
                // remplissage de la variable de session avec le contenu de la requête
                $_SESSION = $response;
                // suppression de 2 variables inutiles
                unset($_SESSION['userpwd'], $_SESSION['useruniqid']);
                // création de la variable de session
                $_SESSION['myID'] = session_id();

                return true;
            } else {
                return "Login et/ou mot de passe incorrecte 2";
            }
        } else {
            return "Login et/ou mot de passe incorrecte 1";
        }
    }
}
