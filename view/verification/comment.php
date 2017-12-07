<?php
if(isset($_POST['add'])){
	if(isset($_POST['comment'])){
		if(!empty(trim($_POST['comment']))){
			extract($_POST);

			$comment = $_POST['comment'];
			$postId = htmlspecialchars($_GET['id']);

			$addComment = new CommentEntity();
			$addComment->setPost_id($postId);
			$addComment->setUser_id($_SESSION['id']);
			$addComment->setAuthor($_SESSION['pseudo']);
			$addComment->setComment($comment);

			$addCommentManager = new Arthur\WriterBlog\Model\CommentEntityManager();
			$addComment = $addCommentManager->addComment($addComment);

			 if ($addComment === false) {
	            echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$_GET['id'].'&addComment=no">';
	        }
	        else {
	        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$_GET['id'].'&addComment=yes">';
	        }	
		}
		else{ 
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$_GET['id'].'&complete=no">';
		}
	}
}

elseif(isset($_POST['delete'])){
		extract($_POST);

		$commentId = $_POST['commentId'];
		$postId = htmlspecialchars($_GET['id']);

		$comment = new CommentEntity();
		$comment->setId($commentId);

		$commentManager = new Arthur\WriterBlog\Model\CommentEntityManager();
		$deleteComment = $commentManager->deleteComment($comment);
		$deleteModeration = $commentManager->deleteCommentModeration($comment);
		
		if ($deleteComment === false) {
		 	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&deleteComment=no">';
	    }
	    else {
	    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&deleteComment=yes">';
	    }
}

elseif(isset($_POST['update'])){
	if(isset($_POST['comment'])){
		if(!empty(trim($_POST['comment']))){
			extract($_POST);

			$commentId = htmlspecialchars($_POST['commentId']);
			$comment = htmlspecialchars($_POST['comment']);
			$postId = htmlspecialchars($_GET['id']);

			$setComment = new CommentEntity();
			$setComment->setId($commentId);
			$setComment->setComment($comment);

			$commentManager = new Arthur\WriterBlog\Model\CommentEntityManager();
			$updateComment = $commentManager->updateComment($setComment);
			
			if ($updateComment === false) {
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&updateComment=no">';
		    }
		    else {
		    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&updateComment=yes">';
		    }
		}
	}
}

elseif(isset($_POST['addModeration'])){
	if(isset($_POST['cause'])){
		if(!empty(trim($_POST['cause']))){
			extract($_POST);

			$cause = htmlspecialchars($_POST['cause']);
			$commentId = htmlspecialchars($_POST['commentId']);
			$postId = $_GET['id'];

			$moderation = new ModerationEntity();
			$moderation->setId_comment($commentId);
			$moderation->setPost_id($postId);
			$moderation->setCause($cause);

			$moderationManager = new Arthur\WriterBlog\Model\ModerationManager();

			$addModeration = $moderationManager->addModeration($moderation);
			if ($addModeration === false) {
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&addModeration=no">';
	        }
	        else {
	        	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&addModeration=yes">';
	        }
		}
	}
}

?>