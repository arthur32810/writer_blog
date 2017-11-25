<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function writePost()
{
    require('view/backend/writePost.php');
}

function createPost(){
    $postManager = new Arthur\WriterBlog\Model\PostManager();

    $createPost = $postManager->createPost($_POST['title'], $_POST['content']);

     if ($createPost === false) {
        header('Location: index.php?action=write_post&create=no');
    }
    else {
        header('Location: index.php?action=write_post&create=yes');
    }
}

function connection(){
	$userManager = new Arthur\WriterBlog\Model\UserManager();

	$pseudo= htmlspecialchars(strip_tags($_POST['pseudo'])); 					 // Recuperation valeur 'pseudo' du formulaire dans variable 'pseudo'
	$pass= sha1(htmlspecialchars(strip_tags($_POST['pass'])));

	$connexion = $userManager->connection($pseudo, $pass);

	if(!$connexion){
		echo "L'identifiant n'existe pas !";
	}
	else{
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['pass'] = $pass;

		session_start();

		echo "C'est connecté";
	}
}

function testConnection(){
	
}