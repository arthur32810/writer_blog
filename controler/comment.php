<?php

function addComment()
{
    $postManager = new Arthur\WriterBlog\Model\PostEntityManager();
    $commentManager = new  Arthur\WriterBlog\Model\CommentEntityManager();
    $postId = htmlspecialchars($_GET['id']);
    $post = $postManager->getPost($postId,'');
    if(!empty($post)){
        
        $comment = htmlspecialchars($_POST['comment']);
        $addComment = $commentManager->addComment($postId, $_SESSION['id'], $_SESSION['pseudo'], $comment);
        if ($addComment === false) {
            header('Location: index.php?action=posts&id='.$_GET['id'].'&addComment=no');
        }
        else {
            header('Location: index.php?action=post&id='.$_GET['id'].'&addComment=yes');
        }
    }
    else{header('Location: index.php?action=listPosts&existPost=no');}
}

function updateComment(){
    require('model/PostEntityManager.php');
    require('model/CommentEntityManager.php');
        
    $postManager = new Arthur\WriterBlog\Model\PostManager();
    $commentManager = new  Arthur\WriterBlog\Model\CommentManager();

    $idComment = htmlspecialchars($_GET['idComment']);
    $idPost = htmlspecialchars($_GET['id']);

    $post = $postManager->getPost($idPost,'');

    if(!empty($post)){
          $existComment = $commentManager->getComment($idComment);

           if(!empty($existComment)){
                $updateComment = $commentManager->updateComment($idComment, htmlspecialchars($_POST['comment']));
                if ($updateComment === false) {
                    header('Location: index.php?action=post&id='.$idPost.'&updateComment=no');
                }
                else {
                    header('Location: index.php?action=post&id='.$idPost.'&updateComment=yes');
                }
            }
            else{header('Location: index.php?action=post&id='.$idPost.'&idComment=no');  }
    }
     else{header('Location: index.php?action=listPosts&existPost=no');}

}

function deleteComment(){
    require('model/PostEntityManager.php');
    require('model/CommentEntityManager.php');

    $postManager = new Arthur\WriterBlog\Model\PostManager();
    $commentManager = new  Arthur\WriterBlog\Model\CommentManager();

    $idComment = htmlspecialchars($_GET['idComment']);
    $idPost = htmlspecialchars($_GET['id']);

    $post = $postManager->getPost($idPost,'');

    if(!empty($post)){

        $existComment = $commentManager->getComment($idComment);

        if(!empty($existComment)){
            $deleteComment = $commentManager->deleteComment($idComment);
            $deleteCommentModeration = $commentManager ->deleteCommentModeration($idComment);
            if ($deleteComment === false) {
                header('Location: index.php?action=post&id='.$idPost.'&deleteComment=no');
            }
            else {
                header('Location: index.php?action=post&id='.$idPost.'&deleteComment=yes');
            }
        }
        else{header('Location: index.php?action=post&id='.$idPost.'&idComment=no');  }
    }
     else{header('Location: index.php?action=listPosts&existPost=no');}
}