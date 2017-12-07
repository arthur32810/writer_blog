<?php

Class CommentEntity
{
    protected $id;
    protected $post_id;
    protected $user_id;
    protected $author;
    protected $comment;

    public function getId()
    {
        return $this->id;
    }
     
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getPost_id()
    {
        return $this->post_id;
    }
     
    public function setPost_id($post_id)
    {
        $this->post_id = $post_id;
        return $this;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }
     
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }
     
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }
     
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
}