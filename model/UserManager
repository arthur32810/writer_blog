<?php
namespace Arthur\WriterBlog\Model;

require_once('model/Manager.php');

class UserManager extends Manager
{
	public function connexion($pseudo, $pass){
		$recuperation_donnees = $bdd->prepare('SELECT * FROM users WHERE pseudo= :pseudo AND pass= :pass');
		$recuperation_donnees ->execute(array(
			'pseudo' => $pseudo,
			'pass' => $pass_hache));

		$donnees = $recuperation_donnees->fetch();

		return $donnees;
	}

	public function cookie(){
		setcookie('pseudo', $_SESSION['pseudo'], time() + 30*24*3600, null, null, false, true);
		setcookie('pass', $_SESSION['pass'], time() + 30*24*3600, null, null, false, true); }
	}
}