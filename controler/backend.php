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

    $createPost = $postManager->createPost($_POST['title'], $_POST['content']);

     if ($createPost === false) {
        header('Location: index.php?action=write_post&create=no');
    }
    else {
        header('Location: index.php?action=write_post&create=yes');
    }
}

function updateWrite(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();

	$post = $postManager->getPost($_GET['postId']);

	require('view/backend/updatePost.php');
}

function updatePost(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();

	$existpost = $postManager->getPost($_GET['id']);

	if(!empty($existpost)){ 
		$updatePost = $postManager->updatePost($_GET['id'], $_POST['chapter'], $_POST['title'], $_POST['content']);

		if ($updatePost === false) {
		    header('Location: index.php?action=write_post&update=no');
		}
		else {
		    header('Location: index.php?action=write_post&update=yes');
		}
	}
	else{echo "L'id n'existe pas ! ";}


}

function deletePost(){
	$postManager = new Arthur\WriterBlog\Model\PostManager();

}
