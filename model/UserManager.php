<?php
namespace Arthur\WriterBlog\Model;

require_once('model/Manager.php');

class UserManager extends Manager
{
	public function getUser($pseudo){
		$db = Manager::dbConnect();

		$recuperation_user = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
		$recuperation_user->execute(array($pseudo));

		$donnees = $recuperation_user->fetch();

		return $donnees;
	}

	public function addUser($pseudo, $pass){
		$db = Manager::dbConnect();

		$role = 'user';

		$addUser = $db->prepare('INSERT INTO users(pseudo, password, role) VALUES (:pseudo, :pass, :role)');
		$addUser->execute(array('pseudo' => $pseudo,
								'pass' => $pass,
								'role' => $role));

		return $addUser;
	}
	public function connection($pseudo, $pass){
		$db = Manager::dbConnect();

		$recuperation_donnees = $db->prepare('SELECT * FROM users WHERE pseudo= :pseudo AND password= :pass');
		$recuperation_donnees ->execute(array(
			'pseudo' => $pseudo,
			'pass' => $pass));

		$donnees = $recuperation_donnees->fetch();

		return $donnees;
	}

	public function cookie(){
		setcookie('pseudo', $_SESSION['pseudo'], time() + 30*24*3600, null, null, false, true);
		setcookie('pass', $_SESSION['pass'], time() + 30*24*3600, null, null, false, true); 
	}

	public function deconnection(){
		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();

		// Suppression des cookies de connexion automatique
		setcookie('login', '');
		setcookie('pass_hache', '');
	}
}