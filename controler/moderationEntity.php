<?php

class ModerationEntity
{
	protected $id;
	protected $id_comment;
	protected $post_id;
	protected $cause;

	public function getId()
	{
	    return $this->id;
	}
	 
	public function setId($id)
	{
	    $this->id = $id;
	    return $this;
	}

	public function getId_comment()
	{
	    return $this->id_comment;
	}
	 
	public function setId_comment($id_comment)
	{
	    $this->id_comment = $id_comment;
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

	public function getCause()
	{
	    return $this->cause;
	}
	 
	public function setCause($cause)
	{
	    $this->cause = $cause;
	    return $this;
	}
}