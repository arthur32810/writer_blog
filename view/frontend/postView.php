<?php $title = "Chapitre ".$post['chapter']." : ".$post['title']; ?>

<?php ob_start(); ?>

	<h1> Chapitre <?= $post['chapter'] ?> :   <?= $post['title'] ?> </h1>

	<a href="index.php?action=listPosts"> Revenir à l'index </a>

	<p> <?= $post['content'] ?> </p>

	<p> publié le : <?= $post['creation_date_fr'] ?> </p>

	<h2> Commentaires </h2>

	<?php		

		if(!empty($_SESSION['pseudo'])){ ?>
			<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
				<div>
					<label for="author">Auteur</label><br />
					<input type="text" id="author" name="author" />
				</div>
				<div>
					<label for="comment">Commentaire</label><br />
					<textarea id="comment" name="comment"></textarea>
				</div>
				<div>
					<input type="submit" />
				</div>
			</form>
	<?php	}
		
		while($comment = $comments->fetch())
		{ ?> 
	
			<div>
				<p> <strong> <?= htmlspecialchars($comment['author'])?> </strong>
					le <?= $comment['comment_date_fr'] ?> 
				</p>					
				<p> <?= htmlspecialchars($comment['comment']) ?> </p>
			</div>
			
		<?php }	

		$comments->closeCursor(); ?>

		<div style="text-align: center;"> <?php

			for ($i=1; $i<= $nb_paging_comments; $i++) { ?>

					<a href="index.php?action=post&id=<?= $post['id']?>&comment_page=<?= $i ?>"> <?= $i ?> </a> 

			<?php }	?>
		</div>	
	

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>

