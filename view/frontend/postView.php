<?php $title = "Chapitre ".$post['chapter']." : ".$post['title']; ?>

<?php ob_start();

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
?>

	<h1> Chapitre <?= $post['chapter'] ?> :   <?= $post['title'] ?> </h1>

	<a href="index.php?action=listPosts"> Revenir à l'index </a>

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

		<div > <?php

			for ($i=1; $i<= $nb_paging_comments; $i++) { ?>

					<a href="index.php?action=post&id=<?= $post['id']?>&comment_page=<?= $i ?>"> <?= $i ?> </a> 

			<?php }	?>
		</div>	
	

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>

