<?php
namespace Arthur\WriterBlog\Model;

require_once('model/Manager.php');

class CommentManager extends Manager
{
	public function pagingComments($postId){
		$db = Manager::dbConnect();

		$paging = $db->prepare('SELECT COUNT(*) AS nb_comments FROM comments WHERE post_id = ?');
		$paging->execute(array($postId));

		$data = $paging->fetch();
	    $nb_comments = $data['nb_comments']; // retourne le nombre d'entrée

	    $nb_paging_comments = (int) ($nb_comments / 5); // divise par 5; 
	    $nb_paging_comments++;

	    return $nb_paging_comments;
	}

	public function getComments($postId, $limit1, $limit2)
	{
		$db = Manager::dbConnect();
		
		$comments = $db->prepare('SELECT id, user_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') 
										AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date LIMIT '.$limit1.','.$limit2.'');
		$comments->execute(array($postId));			
		
		return $comments;
	}
/*
	public function getComment($id)
	{
		$db = $this->dbConnect();
		
		$comment = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') 
										AS comment_date_fr FROM comments WHERE id = ?');
		$comment->execute(array($id));			
		
		$comment = $comment->fetch();
		return $comment;
	}

	public function postComment($postId, $author, $comment)
	{
		$db = $this->dbConnect();
		
		$comments = $db->prepare('INSERT INTO comments (post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())');
		$affectedLines = $comments->execute(array($postId, $author, $comment));
		
		return $affectedLines;
	}

	public function updateComment($id, $author, $comment)
	{
		$db = $this->dbConnect();
		
		$comments = $db->prepare('UPDATE comments SET author = :newauthor, comment = :newcomment, comment_date = NOW() WHERE id = :id');
		$affectedLines = $comments->execute(array(
											'newauthor' => $author,
											'newcomment' => $comment, 
											'id' => $id));
		
		return $affectedLines;
	}*/
}