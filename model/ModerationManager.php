<?php
namespace Arthur\WriterBlog\Model;

require_once('model/Manager.php');

class ModerationManager extends Manager
{
	public function addModeration($commentId, $postId, $cause){
		$db = Manager::dbConnect();

		$addModeration=$db->prepare('INSERT INTO moderation(id_comment, post_id, cause, moderation_date) VALUES(:id_comment, :postId, :cause, NOW())');
		$addModeration->execute(array(
						'id_comment' => $commentId,
						'postId' => $postId, 
						'cause' => $cause));

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

	public function getModeration($id){
		$db = Manager::dbConnect();

		$moderation=$db->prepare('SELECT * FROM moderation WHERE id=?');
		$moderation->execute(array($id));

		$moderation = $moderation->fetch();

		return $moderation;
	}

	public function deleteModeration($id){
		$db = Manager::dbConnect();

		$deleteModeration = $db->prepare('DELETE FROM moderation WHERE id = ?');
		$deleteModeration->execute(array($id));

		return $deleteModeration;
	}
}