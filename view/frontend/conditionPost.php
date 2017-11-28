<?php
		if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
		echo "Tous les champs non pas été rempli";
	}
	elseif (!empty($_GET['update']) && $_GET['update'] == 'yes'){
				echo "Le Chapitre à été modifié";
		}
	elseif (!empty($_GET['addComment']) &&$_GET['addComment'] == 'no'){
			echo "Le commentaire n'a pas pu être ajouté";
		}
	elseif (!empty($_GET['addComment']) &&$_GET['addComment'] == 'yes'){
			echo "Le commentaire a été ajouté";
		}
	elseif (!empty($_GET['idComment']) && $_GET['idComment'] == 'no'){
			echo "L'id du commentaire n'existe pas";
		}

	elseif (!empty($_GET['updateComment'])){
		if($_GET['updateComment'] == 'no'){
			echo "Le Commentaire n'a pas pu être  modifié";
		}
		elseif($_GET['updateComment'] == 'yes'){
			echo "Le Commentaire a été modifié";
		}	
	}
	
	elseif (!empty($_GET['deleteComment'])){
		if($_GET['deleteComment'] == 'no'){
			echo "Le Commentaire n'a pas pu être supprimé";
		}
		elseif($_GET['deleteComment'] == 'yes'){
			echo "Le Commentaire a été supprimé";
		}	
	}
	elseif(!empty($_GET['addModeration'])){
			if($_GET['addModeration'] == 'yes'){
				echo "Le commentaire a bien été signalé";
			}
			elseif($_GET['delete'] == 'no'){
				echo "Le commentaire n'a pas pu être signalé";
			}
		}