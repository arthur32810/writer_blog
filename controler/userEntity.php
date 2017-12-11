<?php

Class UserEntity
{
    protected $id;
    protected $pseudo;
    protected $password;
    protected $role;

    public function getId()
        {
            return $this->id;
        }
         
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }    

    public function getPseudo()
    {
        return $this->pseudo;
    }
     
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
     
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }
     
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public static function inscription(){
        require_once('model/UserEntityManager.php');
        require('view/frontend/userInscription.php');
    }

    public static function connect(){
        session_start();

        if(!empty($_COOKIE['pseudo'])){
             $pseudo = $_COOKIE['pseudo'];} 
        else {$pseudo='';} 
                    
        if(!empty($_COOKIE['pass'])){ 
            $pass = $_COOKIE['pass'];} 
        else{$pass='';} 
         require_once('model/UserEntityManager.php');
         require('view/frontend/userConnexion.php');
    }

    public static function updateUser(){
        require_once('model/UserEntityManager.php');
    
        $pseudo = $_SESSION['pseudo']; 

        $user = new UserEntity();
        $user->setPseudo($pseudo);

        $userManager = new Arthur\WriterBlog\Model\UserEntityManager();
        $existUser = $userManager->getUser($user);

        if(!empty($existUser)){
            $user->setPassword($existUser['password']);
            $user->setId($existUser['id']);
            $passwordCrypt = $userManager->Cryptage($user);
            $user->setPassword($passwordCrypt);

            require('view/frontend/userUpdate.php');
        }
        else{
            echo '<meta http-equiv="refresh" content="0;URL=index.php?action=updateUser&pseudo=no-exist">'; 
        }
    }

    public static function deconnection(){
        // Suppression des variables de session et de la session
        $_SESSION = array();
        session_destroy();

        // Suppression des cookies de connexion automatique
        setcookie('login', '');
        setcookie('pass_hache', '');

        header('Location: index.php?action=listPosts&deconnected=yes');
    }
}