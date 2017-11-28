<?php
require_once('controler/listModel.php');

function addModeration (){
	$postManager = new Arthur\WriterBlog\Model\PostManager();
	$commentManager = new  Arthur\WriterBlog\Model\CommentManager();
	$moderationManager = new Arthur\WriterBlog\Model\ModerationManager();

	$idComment = htmlspecialchars($_GET['commentId']);
	$idPost = htmlspecialchars($_GET['postId']);

	$post = $postManager->getPost($idPost,'');

	 if(!empty($post)){
	 	$existComment = $commentManager->getComment($idComment);

    if(!empty($existComment)){
    	$addModeration = $moderationManager->addModeration($idComment, $idPost, htmlspecialchars($_POST['cause']));
	 		if ($addModeration === false) {
            header('Location: index.php?action=post&id='.$idPost.'&addModeration=no');
        }
        else {
            header('Location: index.php?action=post&id='.$idPost.'&addModeration=yes');
        }
	 	}
	 	 else{header('Location: index.php?action=post&id='.$idPost.'&idComment=no');  }
}
 else{header('Location: index.php?action=listPosts&existPost=no');}
}

function moderation(){
	if($_SESSION['role']=='admin'){
		$moderationManager = new Arthur\WriterBlog\Model\ModerationManager();
		$postManager = new Arthur\WriterBlog\Model\PostManager();
		$commentManager = new  Arthur\WriterBlog\Model\CommentManager();

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

	    $moderations = $moderationManager->getModeration($limit1, $limit2);
	    $pagingModeration = $moderationManager->pagingModeration();


	    require('view/backend/moderationView.php');
	}
	else{header('Location: index.php?action=listPosts&right=no');}

}