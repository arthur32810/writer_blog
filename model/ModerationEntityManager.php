<?php
namespace Arthur\WriterBlog\Model;

require_once('model/Manager.php');

class ModerationEntityManager extends Manager
{
	public function addModeration($moderation){
		$db = Manager::dbConnect();

		$addModeration=$db->prepare('INSERT INTO moderation(id_comment, post_id, cause, moderation_date) VALUES(:id_comment, :postId, :cause, NOW())');
		$addModeration->execute(array(
						'id_comment' => $moderation->getId_comment(),
						'postId' => $moderation->getPost_Id(), 
						'cause' => $moderation->getCause()));

		return $addModeration;
	}

	public function pagingModeration(){
		$db = Manager::dbConnect();

		$paging = $db->query('SELECT COUNT(*) AS nb_moderation FROM moderation');
		$data = $paging->fetch();
	    $nb_moderation = $data['nb_moderation']; // retourne le nombre d'entrée

	    if($nb_moderation == 0){ $nb_paging = $nb_moderation;}
	    elseif($nb_moderation >=1){
	    	$nb_paging = (int) ($nb_moderation / 10); // divise par 10
	    	$nb_paging++;
	    }   

	    return $nb_paging;
	}

	public function getModerations(){
		$db = Manager::dbConnect();

		$moderations = $db->query('SELECT * FROM moderation ORDER BY id ');

		return $moderations;
	}

	public function getModeration($moderation){
		$db = Manager::dbConnect();

		$getModeration=$db->prepare('SELECT * FROM moderation WHERE id=?');
		$getModeration->execute(array($moderation->getId()));

		$moderation = $getModeration->fetch();

		return $moderation;
	}

	public function getModerationComment($moderation){
		$db = Manager::dbConnect();

		$getModeration=$db->prepare('SELECT * FROM moderation WHERE id=?');
		$getModeration->execute(array($moderation->getId_comment()));

		$moderation = $getModeration->fetch();

		return $moderation;
	}

	public function deleteModeration($moderation){
		$db = Manager::dbConnect();

		$deleteModeration = $db->prepare('DELETE FROM moderation WHERE id = ?');
		$deleteModeration->execute(array($moderation->getId()));

		return $deleteModeration;
	}
}