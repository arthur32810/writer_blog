<?php								
	require('controler/frontend.php');
	
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
			writePosts();
		}

		elseif ($_GET['action'] == 'create_post'){
			createPost();
		}
	}

	else { listPosts(); }