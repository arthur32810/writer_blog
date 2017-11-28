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

}