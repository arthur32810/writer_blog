<?php								
	require_once('controler/postEntity.php');
	require_once('controler/postAuthor.php');
	require_once('controler/comment.php');
	require_once('controler/connect.php');
	require_once('controler/moderation.php');
	
	if (isset($_GET['action'])) {

		if ($_GET['action'] == 'listPosts') {
			session_start();
			listPosts();
		}

		elseif ($_GET['action'] == 'post'){
			session_start();
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				post();
			}
			else {
				header('Location: index.php?action=listPosts&existPost=no');
			}
		}

		// Commentaires

		elseif ($_GET['action'] == 'addComment'){
			session_start();
			if(!empty($_POST['comment'])){
				addComment();
			}
			else{ header('Location: index.php?action=post&id='.$_GET['id'].'&complete=no'); }
		}

		elseif($_GET['action'] == 'deleteComment'){
			deleteComment();
		}
		elseif($_GET['action'] == 'updateComment')
		{
			if(!empty($_POST['comment'])){
				updateComment();
			}
			else{ header('Location: index.php?action=post&id='.$_GET['id'].'&complete=no'); }
		}

		// Ecriture chapitre

		elseif ($_GET['action'] == 'write_post'){
				session_start();

				if (!isset($_SESSION['pseudo']))
				{
					//On n'est pas connecté
					header('Location: index.php?action=connect');
					exit();
				}
				elseif($_SESSION['role'] == 'author'){ writePost();}
				else { header('Location: index.php?action=listPosts&right=no');}

				
		}

		elseif ($_GET['action'] == 'create_post'){
			if(!empty($_POST['chapter']) && !empty($_POST['title']) && !empty($_POST['content']))
			{
				createPost();
			}
			else{header('Location: index.php?action=write_post&complete=no');}
		}

		elseif ($_GET['action'] == 'update_post'){
			session_start();

			if (!isset($_SESSION['pseudo']))
			{
				//On n'est pas connecté
				header('Location: index.php?action=connect');
				exit();
			}

			elseif($_SESSION['role'] == 'author'){

					if(!empty($_POST['update'])){
						if(!empty($_POST['chapter']) &&!empty($_POST['title']) && !empty($_POST['content'])){ updatePost(); }
						else{ header('Location: index.php?action=update_post&complete=no'); }
					}
					elseif(!empty($_POST['delete'])){
						if(!empty($_POST['chapter']) &&!empty($_POST['title']) && !empty($_POST['content'])){ deletePost(); }
						else{ header('Location: index.php?action=update_post&complete=no');}
					}
					else{
						updateWrite();
					}
			}
			else { header('Location: index.php?action=listPosts&right=no'); }
		}

		// Espace membres

		elseif($_GET['action'] == 'inscription')
		{
			inscription();
		}

		elseif($_GET['action'] == 'addUser'){
			if(!empty($_POST['pseudo']) &&!empty($_POST['pass']) ){ addUser(); }
			else{ header('Location: index.php?action=inscription&complete=no'); }
		}

		elseif($_GET['action'] == 'connect'){
			connect();
		}

		elseif($_GET['action'] == 'connection')
		{
			if(!empty($_POST['pseudo']) && !empty(['pass'])){
					connection(); 
			}
			else{ header('Location: index.php?action=connect&complete=no');}
		}

		elseif($_GET['action'] == 'updateUser'){
			session_start();

			if (!isset($_SESSION['pseudo']))
			{
				//On n'est pas connecté
				header('Location: index.php?action=listPosts&connected=no');
				exit();
			}
			else{
				if(!empty($_POST['update'])) { updateUser();}
				elseif(!empty($_POST['delete'])){deleteUser();}
				else{updateUser();}
			}
		}

		elseif($_GET['action'] == 'deconnection'){
			session_start();
			deconnection();
		}

		// Modération 

		elseif ($_GET['action'] == 'addModeration') {
			addModeration();
		}
		elseif ($_GET['action'] == 'moderation') {
			session_start();
			moderation();
		}
		elseif ($_GET['action'] == 'updateModeration') {
			updateModeration();
		}
		elseif ($_GET['action'] == 'deleteModeration') {
			deleteModeration();
		}
	}
	else { session_start();
			listPosts(); }