<?php 
namespace Arthur\WriterBlog\Model;

require_once('model/Manager.php');

class PostManager extends Manager
{
	public function getPosts(){
		$db = Manager::dbConnect();

		$posts = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') 
								AS creation_date_fr FROM posts ORDER BY creation_date LIMIT 0, 5');

		return $posts;
	}
}