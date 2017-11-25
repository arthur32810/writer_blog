<?php

require_once('model/PostManager.php');

function listPosts($page)
{
    $postManager = new Arthur\WriterBlog\Model\PostManager();

    if($page>0){
        $limit1 = ($page-1)*5;
        $limit2 = $page*5;
    }
    else{
        $limit1 = 0;
        $limit2 = 5;
    }

    $posts = $postManager->getPosts($limit1, $limit2);
    $nb_paging = $postManager->pagingPosts();

    require('view/frontend/listPostsView.php');
}

/*function listPostsPaging($page)
{
    $postManager = new Arthur\WriterBlog\Model\PostManager();
    
    

    $posts = $postManager->getPosts($limit1, $limit2);

    require('view/frontend/listPostsView.php');
}*/