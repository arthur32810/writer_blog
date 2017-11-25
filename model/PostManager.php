<?php 
namespace Arthur\WriterBlog\Model;

require_once('model/Manager.php');

class PostManager extends Manager
{
	public function pagingPosts(){
		$db = Manager::dbConnect();

		$paging = $db->query('SELECT COUNT(*) AS nb_posts FROM posts');
		$data = $paging->fetch();
	    $nb_posts = $data['nb_posts']; // retourne le nombre d'entrée

	    $nb_paging = (int) ($nb_posts / 5); // divise par 5; 
	    $nb_paging++;

	    return $nb_paging;
	}

	public function getPosts($limit1, $limit2){
		$db = Manager::dbConnect();

		$posts = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') 
								AS creation_date_fr FROM posts ORDER BY creation_date LIMIT '.$limit1.','.$limit2.'');

		return $posts;
	}

	public function getPost($id){
		$db = Manager::dbConnect();

		$req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') 
								AS creation_date_fr FROM posts WHERE id = ?');
		$req->execute(array($id));

		$post = $req->fetch();

		return $post;
	}
}