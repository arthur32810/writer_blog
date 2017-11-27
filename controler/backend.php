<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function writePost()
{
    require('view/backend/writePost.php');
}

function createPost(){
    $postManager = new Arthur\WriterBlog\Model\PostManager();

    $post = $postManager->getPost('',$_POST['chapter']);

    if(!empty($post)){
    	header('Location: index.php?action=write_post&chapter=exist');
    }
    else{

	    $createPost = $postManager->createPost($_POST['chapter'], $_POST['title'], $_POST['content']);

	     if ($createPost === false) {
	        header('Location: index.php?action=write_post&create=no');
	    }
	    else {
	        header('Location: index.php?action=write_post&create=yes');
	    }
	}
}

function updateWrite(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();

	$post = $postManager->getPost($_GET['postId'],'');

	require('view/backend/updatePost.php');
}

function updatePost(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();

	$id = $_GET['id'];

	$existPost = $postManager->getPost($_GET['id'],'');

	if(!empty($existPost)){ 
		$updatePost = $postManager->updatePost($_GET['id'], $_POST['chapter'], $_POST['title'], $_POST['content']);

		if ($updatePost === false) {
		    header('Location: index.php?action=listPosts&update=no');
		}
		else {
		    header('Location: index.php?action=listPosts&update=yes');
		}
	}
	else{echo "L'id n'existe pas ! ";}


}

function deletePost(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();

	$existpost = $postManager->getPost($_GET['id'],'');

	if(!empty($existpost)){ 
		$deletePost = $postManager->deletePost($_GET['id']);

		if ($deletePost === false) {
		    header('Location: index.php?action=listPosts&delete=no');
		}
		else {
		    header('Location: index.php?action=listPosts&delete=yes');
		}
	}
	else{echo "L'id n'existe pas ! ";}

}
