<?php
		if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Tous les champs non pas été rempli
			</div> <?php
	}
	elseif (!empty($_GET['update']) && $_GET['update'] == 'yes'){
			?> <div class="alert alert-success" role="alert">
			  Le Chapitre à été modifié
			</div> <?php
		}
	elseif (!empty($_GET['addComment']) &&$_GET['addComment'] == 'no'){
		?><div class="alert alert-danger" role="alert">
				Le commentaire n'a pas pu être ajouté
			</div> <?php
		}
	elseif (!empty($_GET['addComment']) &&$_GET['addComment'] == 'yes'){
			?> <div class="alert alert-success" role="alert">
			 Le commentaire a été ajouté
			</div> <?php
		}
	elseif (!empty($_GET['idComment']) && $_GET['idComment'] == 'no'){
		?><div class="alert alert-danger" role="alert">
				L'id du commentaire n'existe pas
			</div> <?php
		}

	elseif (!empty($_GET['updateComment'])){
		if($_GET['updateComment'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Le Commentaire n'a pas pu être  modifié
			</div> <?php
		}
		elseif($_GET['updateComment'] == 'yes'){
			?> <div class="alert alert-success" role="alert">
			  Le Commentaire a été modifié
			</div> <?php
		}	
	}
	
	elseif (!empty($_GET['deleteComment'])){
		if($_GET['deleteComment'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Le Commentaire n'a pas pu être supprimé
			</div> <?php
		}
		elseif($_GET['deleteComment'] == 'yes'){
			?> <div class="alert alert-success" role="alert">
			 Le Commentaire a été supprimé
			</div> <?php
		}	
	}
	elseif(!empty($_GET['addModeration'])){
			if($_GET['addModeration'] == 'yes'){
				?> <div class="alert alert-success" role="alert">
					Le commentaire a bien été signalé
				</div> <?php
			}
			
			elseif($_GET['delete'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Le commentaire n'a pas pu être signalé
				</div> <?php
			}
		}