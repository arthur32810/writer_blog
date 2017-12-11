<?php

class ModerationEntity
{
	protected $id;
	protected $id_comment;
	protected $post_id;
	protected $cause;

	public function getId()
	{
	    return $this->id;
	}
	 
	public function setId($id)
	{
	    $this->id = $id;
	    return $this;
	}

	public function getId_comment()
	{
	    return $this->id_comment;
	}
	 
	public function setId_comment($id_comment)
	{
	    $this->id_comment = $id_comment;
	    return $this;
	}

	public function getPost_id()
	{
	    return $this->post_id;
	}
	 
	public function setPost_id($post_id)
	{
	    $this->post_id = $post_id;
	    return $this;
	}

	public function getCause()
	{
	    return $this->cause;
	}
	 
	public function setCause($cause)
	{
	    $this->cause = $cause;
	    return $this;
	}

	public static function moderation(){
		require('model/ModerationEntityManager.php');
		require('model/PostEntityManager.php');
		require('model/CommentEntityManager.php');

		if($_SESSION['role']=='admin' || $_SESSION['role']=='moderator'){
			$moderationManager = new Arthur\WriterBlog\Model\ModerationEntityManager();
			$postManager = new Arthur\WriterBlog\Model\PostEntityManager();
			$commentManager = new  Arthur\WriterBlog\Model\CommentEntityManager();

			$pagingModeration = $moderationManager->pagingModeration();

			if(!empty($_GET['moderation_page']) && $_GET['moderation_page']>0)
		    {
		        $page = htmlspecialchars($_GET['moderation_page']);
		    }
		    else {$page = 1;}

		    if($page>0){
		        $limit1 = ($page-1)*10;
		        $limit2 = $page*10;
		    }
		    else{
		        $limit1 = 0;
		        $limit2 = 10;
		    }

		    $moderations = $moderationManager->getModerations($limit1, $limit2);
		    $pagingModeration = $moderationManager->pagingModeration();


		    require('view/backend/moderationView.php');
		}
		else{header('Location: index.php?action=listPosts&right=no');}
	}
}