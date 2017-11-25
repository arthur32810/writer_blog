<?php								
	require('controler/frontend.php');
	
	if (isset($_GET['action'])) {

		if ($_GET['action'] == 'listPosts') {
			listPosts();
		}

		if ($_GET['action'] == 'post'){
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				post();
			}
			else {
				echo 'Erreur : aucun identifiant de billet envoyé';
			}
		}

		if ($_GET['action'] == 'create_post'){
			createPosts();
		}
	}

	else { listPosts(); }