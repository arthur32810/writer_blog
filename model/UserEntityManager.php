<?php
namespace Arthur\WriterBlog\Model;

require_once('model/Manager.php');

class UserEntityManager extends Manager
{
	public function getUser($user){
		$db = Manager::dbConnect();

		$recuperation_user = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
		$recuperation_user->execute(array($user->getPseudo()));

		$donnees = $recuperation_user->fetch();

		return $donnees;
	}

	public function addUser($user){
		$db = Manager::dbConnect();

		$addUser = $db->prepare('INSERT INTO users(pseudo, password, role) VALUES (:pseudo, :pass, \'view\')');
		$addUser->execute(array('pseudo' => $user->getPseudo(),
								'pass' => $user->getPassword()));

		return $addUser;
	}
	public function connexion($user){
		$db = Manager::dbConnect();

		$recuperation_donnees = $db->prepare('SELECT * FROM users WHERE pseudo= :pseudo AND password= :pass');
		$recuperation_donnees ->execute(array(
			'pseudo' => $user->getPseudo(),
			'pass' => $user->getPassword()));

		$donnees = $recuperation_donnees->fetch();

		return $donnees;
	}

	public function updateUser($user){
		$db = Manager::dbConnect();

		$updateUser = $db->prepare('UPDATE users SET pseudo =:pseudo, password=:password, role=:role WHERE id=:id');
		$updateUser->execute(array(
							'pseudo' => $user->getPseudo(),
							'password' => $user->getPassword(),
							'role'=> $user->getRole(),
							'id' => $user->getId()));

		return $updateUser;
	}

	function deleteUser($user){
		$db = Manager::dbConnect();

		$deleteUser = $db->prepare('DELETE FROM users WHERE id =?');
		$deleteUser->execute(array($user->getId()));

		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();

		// Suppression des cookies de connexion automatique
		setcookie('login', '');
		setcookie('pass_hache', '');

		return $deleteUser;
	}

	function Cryptage($user){

	$Clef = 'blog_ecrivain_OC';

	$LClef = strlen($Clef);
	$LMDP = strlen($user->getPassword());
						
	if ($LClef < $LMDP){
				
		$Clef = str_pad($Clef, $LMDP, $Clef, STR_PAD_RIGHT);
	
	}
				
	elseif ($LClef > $LMDP){

		 $_Clef = substr($Clef, 0,  $LMDP - $LClef);
				
	}
			
	return $user->getPassword() ^ $Clef; // La fonction envoie le texte crypté
			
}
}