<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function inscription(){
	require('view/frontend/userInscription.php');
}

function addUser(){
	$userManager = new Arthur\WriterBlog\Model\UserManager();

	$user = $userManager->getUser($_POST['pseudo']);

	if(!empty($user)){
		header('Location: index.php?action=inscription&user=exist');
	}
	else{ 

		$pseudo= htmlspecialchars(strip_tags($_POST['pseudo'])); 			
		$pass= sha1(htmlspecialchars(strip_tags($_POST['pass'])));

		$addUser = $userManager->addUser($pseudo, $pass);

		if ($updatePost === false) {
			    header('Location: index.php?action=inscription&add=no');
			}
			else {
			    header('Location: index.php?action=listPosts&add=yes');
			}
	}
}

function connect(){
	session_start();

	if(!empty($_COOKIE['pseudo'])){
		 $pseudo = $_COOKIE['pseudo'];} 
	else {$pseudo='';} 
				
	if(!empty($_COOKIE['pass'])){ 
		$pass = $_COOKIE['pass'];} 
	else{$pass='';} 

	 require('view/frontend/userConnexion.php');
}

function connection(){
	$userManager = new Arthur\WriterBlog\Model\UserManager();

	

	$pseudo= htmlspecialchars(strip_tags($_POST['pseudo'])); 
	$pass= htmlspecialchars(strip_tags($_POST['pass']));
	$pass_hache = sha1($pass);

	$connexion = $userManager->connection($pseudo, $pass_hache);

	if(!empty($connexion)){
		session_start();

		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['pass'] = $pass;
		$_SESSION['role'] = $connexion['role'];

		if(!empty($_POST['cookie']))
			{
				$cookie = $userManager->cookie();
			}
		
		header('Location: index.php');		
	}
	else{
		echo "Mauvais identifiant ou mot de passe";
		}
}

function deconnection(){
		$userManager = new Arthur\WriterBlog\Model\UserManager();
		$deconnection = $userManager->deconnection();

		header('Location: index.php');
}