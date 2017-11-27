<?php								
	require_once('controler/frontend.php');
	require_once('controler/backend.php');
	require_once('controler/connect.php');
	
	if (isset($_GET['action'])) {

		if ($_GET['action'] == 'listPosts') {
			session_start();
			listPosts();
		}

		elseif ($_GET['action'] == 'post'){
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				post();
			}
			else {
				echo 'Erreur : aucun identifiant de billet envoyé';
			}
		}

		elseif ($_GET['action'] == 'write_post'){
				session_start();

				if (!isset($_SESSION['pseudo']))
				{
					//On n'est pas connecté
					header('Location: index.php?action=connect');
					exit();
				}
				elseif($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'author'){ writePost();}
				else { echo "Vous n'avez pas le droit de voir cette page";}

				
		}

		elseif ($_GET['action'] == 'create_post'){
			if(!empty($_POST['title']) && !empty($_POST['content']))
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

			elseif($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'author'){

					if(!empty($_POST['update'])){
						updatePost();
					}
					elseif(!empty($_POST['delete'])){
						deletePost();
					}
					else{
						updateWrite();
					}
			}

			else { echo "Vous n'avez pas le droit de voir cette page";}
		}

		elseif($_GET['action'] == 'connect'){
			connect();
		}

		elseif($_GET['action'] == 'connection')
		{
			if(!empty($_POST['pseudo']) && !empty(['pass'])){
					connection(); 
			}
			else{ echo "pseudo ou mot de passe non présent";}
		}

		elseif($_GET['action'] == 'deconnection'){
			session_start();
			deconnection();
		}
	}

	else { session_start();
			listPosts(); }