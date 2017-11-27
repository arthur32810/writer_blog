<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');

function listPosts()
{
    $postManager = new Arthur\WriterBlog\Model\PostManager();

    if(!empty($_GET['post_page']) && $_GET['post_page']>0)
    {
        $page = htmlspecialchars($_GET['post_page']);
    }
    else {$page = 1;}

    if($page>0){
        $limit1 = ($page-1)*5;
        $limit2 = $page*5;
    }
    else{
        $limit1 = 0;
        $limit2 = 5;
    }

    $posts = $postManager->getPosts($limit1, $limit2);
    $nb_paging_posts = $postManager->pagingPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new Arthur\WriterBlog\Model\PostManager();
    $commentManager = new  Arthur\WriterBlog\Model\CommentManager();

    $post = $postManager->getPost(htmlspecialchars($_GET['id']),'');

      if(!empty($_GET['comment_page']) && $_GET['comment_page']>0)
    {
        $page = htmlspecialchars($_GET['comment_page']);
    }
    else {$page = 1;}

    if($page>0){
        $limit1 = ($page-1)*5;
        $limit2 = $page*5;
    }
    else{
        $limit1 = 0;
        $limit2 = 5;
    }

    $comments = $commentManager->getComments($_GET['id'], $limit1, $limit2);
    $nb_paging_comments = $commentManager->pagingComments($_GET['id']);

    require('view/frontend/postView.php');
}
