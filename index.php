<?php								
	require('controler/frontend.php');
	
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'listPosts') {
			listPosts();
		}
	}

	else { listPosts(); }