<?php $title = 'Mon Blog !'; ?>

<?php ob_start();

		if (!empty($_GET['create']) && $_GET['create'] == 'yes'){
				echo "Le Chapitre à été ajouté";
			}

		elseif (!empty($_GET['update'])){
			if ($_GET['update'] == 'yes'){
				echo "Le Chapitre à été modifié";
			}
			elseif($_GET['create'] == 'no'){
				echo "Le chapitre n'a pas pu être modifié";
			}
		}
		elseif(!empty($_GET['delete'])){
			if($_GET['delete'] == 'yes'){
				echo "Le Chapitre à été supprimé";
			}
			elseif($_GET['delete'] == 'no'){
				echo "Le chapitre n'a pas pu être supprimé";
			}
		}

		elseif (!empty($_GET['add']) && $_GET['add'] == 'yes'){
			echo "Vous avez bien été inscrit(e)";
		}
		elseif (!empty($_GET['updateUser']) && $_GET['updateUser'] == 'yes'){
			echo "Votre profil a bien été mis à jour";
		}
		elseif (!empty($_GET['connected']) && $_GET['connected'] == 'no'){
			echo "Vous n'avez pas le droit d'accéder à cette page";
		}
	 ?>
<div>	
	<a href="index.php?action=write_post"> Ecriture </a> <br/>	
	<a href="index.php?action=inscription"> Inscription au site </a> <br/>
	<a href="index.php?action=updateUser"> Modification d'un utilisateur </a> <br>
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
               if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin' || !empty($_SESSION['role']) && $_SESSION['role'] == 'author'){ ?> 
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