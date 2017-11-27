<?php $title = 'Mon Blog !'; ?>

<?php ob_start(); 

		if (!empty($_GET['update'])){
			if ($_GET['update'] == 'yes'){
				echo "Le Chapitre à été modifié";
			}
			elseif($_GET['create'] == 'no'){
				echo "Le chapitre n'a pas pu être modifié";
			}
		} ?>
<div>		
	<a href="index.php?action=deconnection"> Deconnection </a> <br/>
	<a href="index.php?action=connect"> Connection </a>
</div>


		<h1> Mon super blog ! </h1>
		<h2> Derniers billets du blog : </h2>
	
	<?php		
		while($data = $posts->fetch())
		{ ?> 
	
			 <section class="news">
                <h3>
                    <?= htmlspecialchars($data['title']) ?>
                    <em>le <?= $data['creation_date_fr'] ?></em>
                </h3>
                <p>
                    <?= $data['content'] ?>
                    <br />
                    <em><a href="index.php?action=post&&id=<?= $data['id']?>"> Lire le chapitre</a></em>
                </p>
               <?php 
               if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'author'){?> 
           			<a href="index.php?action=update_post&postId=<?= $data['id']?>"> Modification </a> <?php 
           		}?>
            </section>
			
		<?php }
		
		$posts->closeCursor();	?>

		<div style="text-align: center;"> <?php

			for ($i=1; $i<= $nb_paging_posts; $i++) { ?>

					<a href="index.php?action=listPosts&post_page=<?= $i ?>"> <?= $i ?> </a> 

			<?php }	?>
		</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>