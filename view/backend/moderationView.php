<?php $title = "Modération";
$script='<script language="javascript" type="text/javascript">
			function bascule(elem)
			   {
				   etat=document.getElementById(elem).style.display;
				   if(etat=="none"){
				   document.getElementById(elem).style.display="block";
			   }
			   else{
					document.getElementById(elem).style.display="none";
				  }
			   }
		</script>
		<script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>' ?>

<?php ob_start();
	if (!empty($_GET['existModeration']) &&$_GET['existModeration'] == 'no'){ 
		?><div class="alert alert-danger" role="alert">
				Le billet de modération n'existe pas
			</div> <?php
	}
	if (!empty($_GET['complete']) &&$_GET['complete'] == 'no'){ 
		?><div class="alert alert-danger" role="alert">
				Les informations ne sont pas compléte
			</div> <?php
	}
	elseif(!empty($_GET['deleteModeration'])){
		if($_GET['deleteModeration'] == 'no'){
			?><div class="alert alert-danger" role="alert">
				Le billet de modération n'a pas pu être supprimé
			</div> <?php
		}
		elseif($_GET['deleteModeration'] == 'yes'){
			if(!empty($_GET['updateComment']) &&$_GET['updateComment'] == 'yes'){
				?> <div class="alert alert-success" role="alert">
				 Le billet de modération a bien été supprimé et le commentaire modifié
				</div> <?php
			}
			if(!empty($_GET['deleteComment']) &&$_GET['deleteComment'] == 'yes'){
				?> <div class="alert alert-success" role="alert">
				 Le billet de modération a bien été supprimé et le commentaire supprimé
				</div> <?php
			}
		}
	}

?>
	<h1> Page de Modération </h1> 

	<?php		
		$i=0;

		$postEntity = new PostEntity();
		$commentEntity = new CommentEntity();

		while($moderation = $moderations->fetch())  // Récupération des modérations
		{ $i++;
			$postEntity->setId($moderation['post_id']);
			$post = $postManager->getPost($postEntity);?> <br/>
			
			<h4> <a href="index.php?action=post&id=<?= $post['id']?>"> Chapitre n°<?=$post['chapter']?> : <?= $post['title']?> </a></h4> 

			<?php 
			$commentEntity->setId($moderation['id_comment']);
			$comment = $commentManager->getComment($commentEntity); ?>
			<p> <em> Commentaire :</em> <br/>
				<?= $comment['comment']?>
			</p>

			<p> <em> Motif du signalement : </em> <br/>
				<?= $moderation['cause']?>
			</p>

			<p> 
				<form style="display: inline;" method="POST" action=""> <!--Formulaire de suppression -->
					<button class="btn btn-danger" name="deleteModeration" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre commentaire ')"> Supprimé </button>

					<input hidden name="commentId" value=" <?= $comment['id'];?>"/>
					<input hidden name="moderationId" value=" <?= $moderation['id'];?>"/>
				</form>

				<a class="btn btn-primary" style="display: inline; color:white" onclick="bascule('update<?=$i?>'); return false;"> Modifier </a> <!--Formulaire de modification -->
				<div id='update<?=$i?>' style='display:none;'> 
					<form action="" method="post"> <br/>
						<div>
							<label for="comment"> Modifier le Commentaire</label><br />
							<textarea class="form-control" id="comment" name="comment" required> <?= $comment['comment']?> </textarea>
						</div> <br/>

							<input hidden name="commentId" value=" <?= $comment['id'];?>"/>
							<input hidden name="moderationId" value=" <?= $moderation['id'];?>"/>
						<div>
							<input class="btn" name="updateModeration" type="submit" value="Modifier"/>
						</div>
					</form>
				</div>

				
			</p>

	
			
			
		<?php }	

		$moderations->closeCursor(); ?>

		<div class="text-center" > <?php

			for ($i=1; $i<= $pagingModeration; $i++) { ?>

					<a href="index.php?action=moderation&post_page=<?= $i ?>"> <?= $i ?> </a> 

			<?php }	

			if($pagingModeration == 0){ ?>
				<p> Aucun commentaire n'a été signalé </p>
			<?php } ?>
		</div>	
	

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');

require('view/verification/moderation.php'); ?>