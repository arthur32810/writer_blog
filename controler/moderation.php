<?php
require_once('controler/listModel.php');

/*function addModeration (){
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
}*/

function moderation(){
	if($_SESSION['role']=='admin' || $_SESSION['role']=='moderator'){
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

	    $moderations = $moderationManager->getModerations($limit1, $limit2);
	    $pagingModeration = $moderationManager->pagingModeration();


	    require('view/backend/moderationView.php');
	}
	else{header('Location: index.php?action=listPosts&right=no');}

}

function updateModeration(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();
    $commentManager = new  Arthur\WriterBlog\Model\CommentManager();
    $moderationManager = new Arthur\WriterBlog\Model\ModerationManager();

    $idPost = htmlspecialchars($_GET['id']);
    $idComment = htmlspecialchars($_GET['idComment']);
    $idModeration = htmlspecialchars($_GET['idModeration']);

    $post = $postManager->getPost($idPost,'');
    
    if(!empty($post)){
          $existComment = $commentManager->getComment($idComment);

           if(!empty($existComment)){
           		$existModeration = $moderationManager->getModeration($idModeration);

           		if(!empty($existModeration)){
           			
           			
	                $updateComment = $commentManager->updateComment($idComment, htmlspecialchars($_POST['comment']));

	                if ($updateComment === false) {
	                    header('Location: index.php?action=post&id='.$idPost.'&updateComment=no');
	                }
	                else {
	                	$deleteModeration = $moderationManager->deleteModeration($idModeration);
	                	if ($updateComment === false) {
	                    	header('Location: index.php?action=moderation&deleteModeration=no');
		                }
		                else {header('Location: index.php?action=moderation&deleteModeration=yes&updateComment=yes');
		                }
	                }
           		}
           		else{header('Location: index.php?moderation&existModeration=no');}
           
            }
            else{header('Location: index.php?action=post&id='.$idPost.'&idComment=no');  }
    }
     else{header('Location: index.php?action=listPosts&existPost=no');}
}

function deleteModeration(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();
    $commentManager = new  Arthur\WriterBlog\Model\CommentManager();
     $moderationManager = new Arthur\WriterBlog\Model\ModerationManager();

    $idPost = htmlspecialchars($_GET['id']);
    $idComment = htmlspecialchars($_GET['idComment']);
   	$idModeration = htmlspecialchars($_GET['idModeration']);

    $post = $postManager->getPost($idPost,'');

    if(!empty($post)){

        $existComment = $commentManager->getComment($idComment);

         if(!empty($existComment)){
           		$existModeration = $moderationManager->getModeration($idModeration);

           		if(!empty($existModeration)){
           			
           			$deleteComment = $commentManager->deleteComment($idComment);
		            
		            if ($deleteComment === false) {
		                header('Location: index.php?action=post&id='.$idPost.'&deleteComment=no');
		            }
	                
	                else {
	                	$deleteModeration = $moderationManager->deleteModeration($idModeration);
	                	
	                	if ($updateComment === false) {
	                    	header('Location: index.php?action=moderation&deleteModeration=no');
		                }
		                else {header('Location: index.php?action=moderation&deleteModeration=yes&deleteComment=yes');
		                }
	                }
           		}
           		else{header('Location: index.php?moderation&existModeration=no');}
           
            }
            else{header('Location: index.php?action=post&id='.$idPost.'&idComment=no');  }
    }
     else{header('Location: index.php?action=listPosts&existPost=no');}
}