<?php

require_once('controler/listModel.php');

function writePost()
{
    require('view/backend/writePost.php');
}

function createPost(){
    $postManager = new Arthur\WriterBlog\Model\PostManager();

    $chapter = htmlspecialchars($_POST['chapter']);

    $post = $postManager->getPost('',$chapter);

    if(!empty($post)){
    	header('Location: index.php?action=update_post&postId='.$post['id'].'&chapter=exist');
    }
    else{

    	$title = htmlspecialchars($_POST['title']);
    	$content = $_POST['content'];

	    $createPost = $postManager->createPost($chapter, $title, $content);

	     if ($createPost === false) {
	        header('Location: index.php?action=write_post&create=no');
	    }
	    else {
	        header('Location: index.php?action=listPosts&create=yes');
	    }
	}
}

function updateWrite(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();

	$postId = htmlspecialchars($_GET['postId']);

	$post = $postManager->getPost($postId,'');

	require('view/backend/updatePost.php');
}

function updatePost(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();

	$id = htmlspecialchars($_GET['id']);

	$existPost = $postManager->getPost($id,'');

	if(!empty($existPost)){ 
		$chapter = htmlspecialchars($_POST['chapter']);
		$title = htmlspecialchars($_POST['title']);
    	$content = htmlspecialchars($_POST['content']);

		$updatePost = $postManager->updatePost($id, $chapter, $title, $content);

		if ($updatePost === false) {
		    header('Location: index.php?action=listPosts&update=no');
		}
		else {
		    header('Location: index.php?action=post&id='.$_GET['id'].'&update=yes');
		}
	}
	else{echo "L'id n'existe pas ! ";}


}

function deletePost(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();
	$commentManager = new  Arthur\WriterBlog\Model\CommentManager();

	$id = htmlspecialchars($_GET['id']);

	$existpost = $postManager->getPost($id,'');

	if(!empty($existpost)){ 
		$deletePost = $postManager->deletePost($id);

		if ($deletePost === false) {
		    header('Location: index.php?action=listPosts&delete=no');
		}
		else {
			$deleteComment = $commentManager->deleteCommentChapter($id);
			$deletePostModeration = $postManager->deletePostModeration($id);
		    
		    if ($deleteComment === false) {
		    	header('Location: index.php?action=listPosts&delete=no');
			}
			else{header('Location: index.php?action=listPosts&delete=yes');}
		}
	}
	else{echo "L'id n'existe pas ! ";}

}
