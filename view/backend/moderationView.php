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
	if (!empty($_GET['existPost']) &&$_GET['existPost'] == 'no'){
		?><div class="alert alert-danger" role="alert">
				Le billet de modération n'existe pas
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
	
		while($moderation = $moderations->fetch())
		{ $post = $postManager->getPost($moderation['post_id'],'');?> <br/>
			<h4> <a href="index.php?action=post&id=<?= $post['id']?>"> Chapitre n°<?=$post['chapter']?> : <?= $post['title']?> </a></h4> 

		<?php $comment = $commentManager->getComment($moderation['id_comment']); ?>
			<p> <em> Commentaire :</em> <br/>
				<?= $comment['comment']?>
			</p>

			<p> <em> Motif du signalement : </em> <br/>
				<?= $moderation['cause']?>
			</p>

			<p> 
				<form style="display: inline; "method="POST" action="index.php?action=deleteModeration&id=<?= $post['id']?>&idComment=<?= $comment['id']?>&idModeration=<?= $moderation['id']?>">
					<button class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre commentaire ')"> Supprimé </button>
				</form>

				<a class="btn btn-primary" style="display: inline;" onclick="bascule('update'); return false;"> Modifier le commentaire </a>
				<div id='update' style='display:none;'> 
					<form action="index.php?action=updateModeration&amp;id=<?= $post['id'] ?>&idComment=<?= $comment['id']?>&idModeration=<?= $moderation['id']?>" method="post">
						<div>
							<label for="comment"> Modifier votre Commentaire</label><br />
							<textarea class="form-control" id="comment" name="comment" required> <?= $comment['comment']?></textarea>
						</div> <br/>
						<div>
							<input class="btn" type="submit" value="Modifier"/>
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

<?php require('view/template.php');?>

