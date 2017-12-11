<?php
if(isset($_POST['add'])){
	if(isset($_POST['chapter']) && isset($_POST['title']) && isset($_POST['content'])){
		if(!empty(trim($_POST['chapter'])) && !empty(trim($_POST['title'])) && !empty(trim($_POST['content']))){
			extract($_POST);

			$chapter = htmlspecialchars($_POST['chapter']);
			$title = htmlspecialchars($_POST['title']);
			$content = htmlspecialchars($_POST['content']);

			$post = new PostEntity(); // Instance de la classe PostEntity
			$post->setChapter($chapter);
			$post->setTitle($title);
			$post->setContent($content);

			$postManager = new Arthur\WriterBlog\Model\PostEntityManager(); //Instance du manager PostEntityManager
			$existPost = $postManager->getPost($post); //Test si le chapitre existe

			if(!empty($existPost)){ //Chapitre existe, on redirige
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_post&postId='.$existPost['id'].'&chapter=exist">';
		    }

		    else{ //il n'existe pas, on continue
		    	$createPost = $postManager->createPost($post);

			    if ($createPost === false) {
			    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=write_post&create=no">';
			    }
			    else {
			    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&create=yes">';
				}

			}
		}
		else{
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=write_post&complete=no">';
		}
	}
	else{
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=write_post&complete=no">';
	}
}

if(isset($_POST['update'])){
	if(isset($_POST['chapter']) && isset($_POST['title']) && isset($_POST['content'])){
		if(!empty(trim($_POST['chapter'])) && !empty(trim($_POST['title'])) && !empty(trim($_POST['content']))){
			extract($_POST);

			$chapter = $_POST['chapter'];
			$title = $_POST['title'];
			$content = $_POST['content'];
			$postId = $post['id'];

			$post = new PostEntity();
			$post->setId($postId);
			$post->setChapter($chapter);
			$post->setTitle($title);
			$post->setContent($content);

			$postManager = new Arthur\WriterBlog\Model\PostEntityManager();
			$existPost = $postManager->getPost($post);

			if(!empty($existPost)){ 
				$updatePost = $postManager->updatePost($post);
				if ($updatePost === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&update=no">'; 
				}
				else {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=post&id='.$postId.'&update=yes">'; 
				}

			}
			else{
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&existPost=no">'; 
			}
		}
		else{ 
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_post&complete=no">'; 
		}
	}
	else{ 
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_post&complete=no">'; 
	}
}

elseif(isset($_POST['delete'])){
	if(isset($_POST['chapter']) && isset($_POST['title']) && isset($_POST['content'])){
		if(!empty(trim($_POST['chapter'])) && !empty(trim($_POST['title'])) && !empty(trim($_POST['content']))){
			extract($_POST);

			$postId = $post['id'];

			$post = new PostEntity();
			$post->setId($postId);

			$postManager = new Arthur\WriterBlog\Model\PostEntityManager();
			$existPost = $postManager->getPost($post);

			if(!empty($existPost)){ 

				$deletePost = $postManager->deletePost($post);
				if ($deletePost === false) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&delete=no">';
				}
				else {
					$commentManager = new Arthur\WriterBlog\Model\CommentEntityManager();

					$deleteComment = $commentManager->deleteCommentChapter($post);
					$deletePostModeration = $postManager->deletePostModeration($post);
				    
				    if ($deleteComment === false) {
				    	echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&delete=no">';
					}
					else{
						echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&delete=yes">';
					}
				}
			}
			else{
				echo '<meta http-equiv="refresh" content="0;URL=index.php?action=listPosts&existPost=no">'; 
			}
		}
		else{ 
			echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_post&complete=no">'; 
		}
	}
	else{ 
		echo '<meta http-equiv="refresh" content="0;URL=index.php?action=update_post&complete=no">'; 
	}
}