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
