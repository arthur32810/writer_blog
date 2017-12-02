<?php $title = "Chapitre ".$post['chapter']." : ".$post['title']; 
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
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>'?>

<?php ob_start(); ?>
	

	<?php include('conditionPost.php'); ?>

	<a href="index.php?action=listPosts"> Revenir aux chapitres </a>

	<h1> Chapitre <?= $post['chapter'] ?> :   <?= $post['title'] ?> </h1>

	<p> <?= $post['content'] ?> </p>

	<p> publié le : <?= $post['creation_date_fr'] ?> </p>

	<h2> Commentaires </h2>

	<?php		

		if(!empty($_SESSION['pseudo'])){ ?>
			<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
				<div>
					<label for="comment">Ajouter un Commentaire</label><br />
					<textarea id="comment" name="comment" required></textarea>
				</div>
				<div>
					<input type="submit" class="btn" />
				</div>
			</form>
	<?php	}
		
		while($comment = $comments->fetch())
		{ ?> 
	
			<div>
				<p> <strong> <?= htmlspecialchars($comment['author'])?> </strong>
					<em> le <?= $comment['comment_date_fr'] ?> </em>
				</p>					
				<p> <?= htmlspecialchars($comment['comment']) ?> </p>

				<?php 
					if(!empty($_SESSION['pseudo']) && $comment['user_id'] != $_SESSION['id']){?> 
						<p> 
							<button type="button" data-toggle="modal" data-target="#signaler" class="btn btn-primary">Signaler</button>
							<div class="modal fade" id="signaler" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h4 class="modal-title">Signaler ce commentaire</h4>
							        <button type="button" class="close" data-dismiss="modal">x</button>
							      </div>
							      <div class="modal-body">
							       	<form method="post" action="index.php?action=addModeration&postId=<?= $post['id'] ?>&commentId=<?= $comment['id']?>">
									   <p>
									      <label>Raison du signalement : </label> <br/>
									      <input type="text" name="cause" required/> <br />
									   </p>

									   <button type="submit" class="btn"> Signaler </button>
									</form>
							      </div>
							      <div class="modal-footer">
							        <button class="btn btn-info" data-dismiss="modal">Annuler</button>
							      </div>
							    </div>
							  </div>
							</div>
						</p> 
				<?php } ?>

				<p> <?php if (!empty($_SESSION['pseudo'])){
							if( $comment['user_id'] == $_SESSION['id'] || $_SESSION['role']=='admin'){ ?>
									<form style="display: inline;" method="POST" action="index.php?action=deleteComment&id=<?= $post['id']?>&idComment=<?= $comment['id']?>">
										<button class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre commentaire ')"> Supprimé </button>
									</form>

									<button class="btn btn-primary" onclick="bascule('update'); return false;"> Modifier </button>
									<div id='update' style='display:none;'> <br/>
										<form action="index.php?action=updateComment&amp;id=<?= $post['id'] ?>&idComment=<?= $comment['id']?>" method="post">
											<div>
												<textarea id="comment" name="comment" required> <?= $comment['comment']?></textarea>
											</div>
											<div>
												<input class="btn" type="submit" value="Modifier"/>
											</div>
										</form>
									</div>												
								<?php } 
							}?>
				</p>
			</div>
			
		<?php }	?>


		<div class="text-center" > <?php
			for ($i=1; $i<= $nb_paging_comments; $i++) { ?>

					<a href="index.php?action=post&id=<?= $post['id']?>&comment_page=<?= $i ?>"> <?= $i ?> </a> 

			<?php }	?>
		</div>

		<?php $comments->closeCursor(); ?>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>

