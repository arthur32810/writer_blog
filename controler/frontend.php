<?php

require_once('model/PostManager.php');

function listPosts()
{
    $postManager = new Arthur\WriterBlog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}