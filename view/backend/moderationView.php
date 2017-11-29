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
		echo "Le billet de modération n'existe pas";
	}
	elseif(!empty($_GET['deleteModeration'])){
		if($_GET['deleteModeration'] == 'no'){
			echo "Le billet de modération n'a pas pu être supprimé";
		}
		elseif($_GET['deleteModeration'] == 'yes'){
			if(!empty($_GET['updateComment']) &&$_GET['updateComment'] == 'yes'){
				echo "Le billet de modération a bien été supprimé et le commentaire modifié";
			}
			if(!empty($_GET['deleteComment']) &&$_GET['deleteComment'] == 'yes'){
				echo "Le billet de modération a bien été supprimé et le commentaire supprimé";
			}
		}
	}

?>
	<h2> Page de Modération </h2>
	<?php		
	
		while($moderation = $moderations->fetch())
		{ $post = $postManager->getPost($moderation['post_id'],'');?>
			<h2> <a href="index.php?action=post&id=<?= $post['id']?>"> Chapitre n°<?=$post['chapter']?> : <?= $post['title']?> </a></h2> 

		<?php $comment = $commentManager->getComment($moderation['id_comment']); ?>
			<p> Commentaire : <br/>
				<?= $comment['comment']?>
			</p>

			<p> Motif du signalement : <br/>
				<?= $moderation['cause']?>
			</p>

			<p> 
				<a href="" onclick="bascule('update'); return false;"> Modifier le commentaire </a>
				<div id='update' style='display:none;'> 
					<form action="index.php?action=updateModeration&amp;id=<?= $post['id'] ?>&idComment=<?= $comment['id']?>&idModeration=<?= $moderation['id']?>" method="post">
						<div>
							<label for="comment"> Modifier votre Commentaire</label><br />
							<textarea id="comment" name="comment" required> <?= $comment['comment']?></textarea>
						</div>
						<div>
							<input type="submit" value="Modifier"/>
						</div>
					</form>
				</div>

				<form method="POST" action="index.php?action=deleteModeration&id=<?= $post['id']?>&idComment=<?= $comment['id']?>&idModeration=<?= $moderation['id']?>">
					<button class="btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre commentaire ')"> Supprimé </button>
				</form>
			</p>

	
			
			
		<?php }	

		$moderations->closeCursor(); ?>

		<div > <?php

			for ($i=1; $i<= $pagingModeration; $i++) { ?>

					<a href="index.php?action=moderation&post_page=<?= $i ?>"> <?= $i ?> </a> 

			<?php }	?>
		</div>	
	

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>

