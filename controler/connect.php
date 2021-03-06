<?php

require_once('controler/listModel.php');

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
		$pass= htmlspecialchars(strip_tags($_POST['pass']));

		$mdp_crypt = $userManager->Cryptage($pass);

		$addUser = $userManager->addUser($pseudo, $mdp_crypt);

		if ($addUser === false) {
			    header('Location: index.php?action=inscription&add=no');
			}
			else {
			    header('Location: index.php?action=connect&add=yes');
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
	$mdp_crypt = $userManager->Cryptage($pass);

	$connexion = $userManager->connection($pseudo, $mdp_crypt);

	if(!empty($connexion)){
		session_start();

		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['pass'] = $pass;
		$_SESSION['role'] = $connexion['role'];
		$_SESSION['id'] = $connexion['id'];

		if(!empty($_POST['cookie']))
			{
				$cookie = $userManager->cookie();
			}
		
		header('Location: index.php');		
	}
	else{ header('Location: index.php?action=connect&good=no');		}
}

function updateUser(){
	$userManager = new Arthur\WriterBlog\Model\UserManager();

	if(!empty($_POST['pseudoSearch'])){
		$pseudo = $_POST['pseudoSearch'];
	}
	else{ $pseudo = $_SESSION['pseudo']; }

	$user = $userManager->getUser($pseudo);

	if(!empty($user)){

		if(!empty($_GET['require']) == 'ok' ){
			if(!empty($_POST['pseudo']) && !empty($_POST['pass'])){
				if(!empty($_POST['newPass']) && !empty($_POST['confirmNewPass']) && $_POST['newPass']==$_POST['confirmNewPass']) {
					$pass = htmlspecialchars($_POST['newPass']);
				}
				
				$pseudo= htmlspecialchars(strip_tags($_POST['pseudo'])); 			
				$pass= htmlspecialchars(strip_tags($_POST['pass']));

				$mdp_crypt = $userManager->Cryptage($pass);

				if($_SESSION['role'] == 'admin'){
					$role = $_POST['role'];
				}
				else{$role = $user['role']; }

				$existUser = $userManager->getUser($pseudo);

				if(empty($existUser)){
					$updateUser = $userManager->updateUser(htmlspecialchars($_POST['id']), $pseudo, $mdp_crypt, $role);

					if ($updateUser === false) {
					    header('Location: index.php?action=updateUser&add=no');
					}
					else {
					    header('Location: index.php?action=listPosts&updateUser=yes');
					}
				}
				else { header('Location: index.php?action=updateUser&pseudo=exist');}

				

			}
			else{header('Location: index.php?action=updateUser&complete=no');}
		}
		else{
			$pseudo = $user['pseudo'];
			$pass = $userManager->Cryptage($user['password']);
			require('view/frontend/userUpdate.php');
		}
	}
	else{header('Location: index.php?action=updateUser&pseudo=no-exist'); }
}

function deleteUser(){
	$userManager = new Arthur\WriterBlog\Model\UserManager();

	$deleteUser = $userManager->deleteUser($_POST['id']);
	if ($updateUser === false) {
		    header('Location: index.php?action=updateUser&deleteUser=no');
		}
		else {
		    header('Location: index.php?action=listPosts&deleteUser=yes');
		}
}

function deconnection(){
	$userManager = new Arthur\WriterBlog\Model\UserManager();
	$deconnection = $userManager->deconnection();

	header('Location: index.php');
}