<?php
namespace Arthur\WriterBlog\Model;

require_once('model/Manager.php');

class UserManager extends Manager
{
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
	}
}