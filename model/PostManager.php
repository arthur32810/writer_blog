<?php 
namespace OpenClassrooms\Blog\Model;

class PostManager extends Manager
{
	public function getPosts(){
		$db = Manager::dbConnect();

		$posts = $db->query('SELECT * FROM posts');

		return $req;
	}
}