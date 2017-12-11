<?php								
	require_once('controler/postEntity.php');
	require_once('controler/commentEntity.php');
	require_once('controler/userEntity.php');
	require_once('controler/moderationEntity.php');
	
	if (isset($_GET['action'])) {

		// Vue chapitre

		if ($_GET['action'] == 'listPosts') { //Demande tous les chapitres
			session_start();
			PostEntity::listPosts();
		}

		elseif ($_GET['action'] == 'post'){ // Demande le chapitre $_GET['id'];
			session_start();
			if (isset($_GET['id']) && $_GET['id'] > 0) {
				PostEntity::post();
			}
			else {
				header('Location: index.php?action=listPosts&existPost=no');
			}
		}

		// Ecriture chapitre

		elseif ($_GET['action'] == 'write_post'){ // Accés à la page d'écriture pour l'utilisateur avec role "Author"
				session_start();

				if (!isset($_SESSION['pseudo']))
				{
					//On n'est pas connecté
					header('Location: index.php?action=connect');
					exit();
				}
				elseif($_SESSION['role'] == 'author'){ PostEntity::writePost();}
				else { header('Location: index.php?action=listPosts&right=no');}

				
		}

		//Modifier un chapitre
		elseif ($_GET['action'] == 'update_post'){
			session_start();

			if (!isset($_SESSION['pseudo']))
			{
				//On n'est pas connecté
				header('Location: index.php?action=connect');
				exit();
			}

			elseif($_SESSION['role'] == 'author'){
				if (isset($_GET['postId']) && $_GET['postId'] > 0) {
					PostEntity::updateWrite();
				}
				else {
					header('Location: index.php?action=listPosts&existPost=no');
				}
			}
			else { header('Location: index.php?action=listPosts&right=no'); }
		}

		// Espace membres

		elseif($_GET['action'] == 'inscription') // Inscription
		{
			UserEntity::inscription();
		}

		elseif($_GET['action'] == 'connect'){ // Connexion
			UserEntity::connect();
		}

		elseif($_GET['action'] == 'updateUser'){ // Modification Compte
			session_start();

			if (!isset($_SESSION['pseudo']))
			{
				//On n'est pas connecté
				header('Location: index.php?action=listPosts&connected=no');
				exit();
			}
			else{UserEntity::updateUser();}
				
		}
		
		elseif($_GET['action'] == 'deconnection'){
			session_start();
			UserEntity::deconnection();
		}

		// Modération 

		elseif ($_GET['action'] == 'moderation') {
			session_start();
			ModerationEntity::moderation();
		}
		elseif ($_GET['action'] == 'updateModeration') {
			updateModeration();
		}
		elseif ($_GET['action'] == 'deleteModeration') {
			deleteModeration();
		}
	}
	else { session_start();
			PostEntity::listPosts(); }