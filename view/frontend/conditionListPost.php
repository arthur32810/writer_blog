<?php if (!empty($_GET['create']) && $_GET['create'] == 'yes'){
				echo "Le Chapitre à été ajouté";
			}
		if (!empty($_GET['right']) && $_GET['right'] == 'no'){
				echo "Vous n'avez pas le droit de voir cette page";
			}
		elseif (!empty($_GET['existPost']) &&$_GET['existPost'] == 'no'){
			echo "Le chapitre n'existe pas";
		}

		elseif (!empty($_GET['update']) &&$_GET['create'] == 'no'){
			echo "Le chapitre n'a pas pu être modifié";
		}
		elseif(!empty($_GET['delete'])){
			if($_GET['delete'] == 'yes'){
				echo "Le Chapitre à été supprimé";
			}
			elseif($_GET['delete'] == 'no'){
				echo "Le chapitre n'a pas pu être supprimé";
			}
		}

		elseif (!empty($_GET['updateUser']) && $_GET['updateUser'] == 'yes'){
			echo "Votre profil a bien été mis à jour";
		}
		elseif (!empty($_GET['deleteUser']) && $_GET['deleteUser'] == 'yes'){
			echo "Votre profil a bien été supprimé";
		}
		elseif (!empty($_GET['connected']) && $_GET['connected'] == 'no'){
			echo "Vous n'avez pas le droit d'accéder à cette page";
		}