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

<?php ob_start();?>

	<?php		
	
		while($moderation = $moderations->fetch())
		{ $post = $postManager->getPost($moderation['post_id'],'');?>
			<h2> <a href="index.php?action=post&id=<?= $post['id']?>"> Chapitre n°<?=$post['chapter']?> : <?= $post['title']?> </a></h2> 

		<?php $comment = $commentManager->getComment($moderation['id_comment']); ?>
			<p> Commentaire : <br/>
				<?= $comment['comment']?>
			</p>

			<p> 
					<form method="POST" action="index.php?action=deleteComment&id=<?= $post['id']?>&idComment=<?= $comment['id']?>">
						<button onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre commentaire ')"> Supprimé </button>
					</form>

					<a href="" onclick="bascule('update'); return false;"> Modifier le commentaire </a>
					<div id='update' style='display:none;'> 
						<form action="index.php?action=updateComment&amp;id=<?= $post['id'] ?>&idComment=<?= $comment['id']?>" method="post">
							<div>
								<label for="comment"> Modifier votre Commentaire</label><br />
								<textarea id="comment" name="comment" required> <?= $comment['comment']?></textarea>
							</div>
							<div>
								<input type="submit" value="Modifier"/>
							</div>
						</form>
					</div>
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

