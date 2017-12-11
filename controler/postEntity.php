<?php
class PostEntity
{
    protected $id;
    protected $chapter;
    protected $title;
    protected $content; 
    protected $creation_date;
    protected $update_date;

    public function getId()
    {
        return $this->id;
    }
     
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getChapter()
    {
        return $this->chapter;
    }
      
    public function setChapter($chapter)
    {
        $this->chapter = $chapter;
        return $this;
    } 

    public function getTitle()
    {
        return $this->title;
    }
     
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }
     
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getCreation_date()
    {
        return $this->creation_date;
    }
     
    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;
        return $this;
    }

    public function getUpdate_date()
    {
        return $this->update_date;
    }
     
    public function setUpdate_date($update_date)
    {
        $this->update_date = $update_date;
        return $this;
    }

    public static function listPosts()
    {
        require('model/PostEntityManager.php');

        $postManager = new Arthur\WriterBlog\Model\PostEntityManager();

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

    public static function post()
    {
        require('model/PostEntityManager.php');
        require('model/CommentEntityManager.php');
        require('model/ModerationEntityManager.php');
        
        $paging ='';

        $postId = htmlspecialchars($_GET['id']);

        $post = new PostEntity();
        $post->setId($postId);

        $postManager = new Arthur\WriterBlog\Model\PostEntityManager();

        $post = $postManager->getPost($post);

        if(!empty($post))
        {
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

            $commentManager = new Arthur\WriterBlog\Model\CommentEntityManager();

            $comments = $commentManager->getComments($_GET['id'], $limit1, $limit2);
            $nb_paging_comments = $commentManager->pagingComments($_GET['id']);

            require('view/frontend/postView.php');
        }  
        else{header('Location: index.php?action=listPosts&existPost=no');}
    }

    public static function writePost()
    {
        require('model/PostEntityManager.php');
        require('view/backend/writePost.php');
    }

    public static function updateWrite(){
        require('model/PostEntityManager.php');
         require('model/CommentEntityManager.php');

        $postId = htmlspecialchars($_GET['postId']);

        $post = new PostEntity();
        $post->setId($postId);

        $postManager = new Arthur\WriterBlog\Model\PostEntityManager();
        $post = $postManager->getPost($post);

        if(!empty($post))
        {
            require('view/backend/updatePost.php');
        }
        else{header('Location: index.php?action=listPosts&existPost=no');}
    }
}