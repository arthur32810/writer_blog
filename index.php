<?php								
	require_once('controler/frontend.php');
	require_once('controler/backend.php');
	
	if (isset($_GET['action'])) {

		if ($_GET['action'] == 'listPosts') {
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
			writePost();
		}

		elseif ($_GET['action'] == 'create_post'){
			if(!empty($_POST['title']) && !empty($_POST['content']))
			{
				createPost();
			}
			else{header('Location: index.php?action=write_post&complete=no');}
		}

		elseif($_GET['action'] == 'connexion')
		{
			if(!empty($_POST['pseudo']) && !empty(['pass'])){
				connection();
			}
			else{ echo "pseudo ou mot de passe non présent"}
		}
	}

	else { listPosts(); }