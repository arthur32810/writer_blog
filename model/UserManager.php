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

		$role = 'view';

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

	public function updateUser($id, $pseudo, $pass, $role){
		$db = Manager::dbConnect();

		$updateUser = $db->prepare('UPDATE users SET pseudo =:pseudo, password=:pass, role=:role WHERE id=:id');
		$updateUser->execute(array(
							'pseudo' => $pseudo,
							'pass' => $pass,
							'role'=> $role,
							'id' => $id));

		return $updateUser;
	}

	function deleteUser($id){
		$db = Manager::dbConnect();

		$deleteUser = $db->prepare('DELETE FROM users WHERE id =?');
		$deleteUser->execute(array($id));

		// Suppression des variables de session et de la session
		$_SESSION = array();
		session_destroy();

		// Suppression des cookies de connexion automatique
		setcookie('login', '');
		setcookie('pass_hache', '');

		return $deleteUser;
	}

	function Cryptage($MDP){

	$Clef = 'blog_ecrivain_OC';

	$LClef = strlen($Clef);
	$LMDP = strlen($MDP);
						
	if ($LClef < $LMDP){
				
		$Clef = str_pad($Clef, $LMDP, $Clef, STR_PAD_RIGHT);
	
	}
				
	elseif ($LClef > $LMDP){

		 $_Clef = substr($Clef, 0,  $LMDP - $LClef);
				
	}
			
	return $MDP ^ $Clef; // La fonction envoie le texte crypté
			
}
}