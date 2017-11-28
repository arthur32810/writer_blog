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

	    $nb_paging = (int) ($nb_moderation / 10); // divise par 10
	    $nb_paging++;

	    return $nb_paging;
	}

	public function getModeration(){
		$db = Manager::dbConnect();

		$moderation = $db->query('SELECT * FROM moderation');

		return $moderation;
	}

	public function testModeration(){echo "test";}
}