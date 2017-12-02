<?php $title = 'Mon Blog !'; ?>

<?php ob_start(); ?>
	
	<?php		
	include('conditionListPost.php');

	while($data = $posts->fetch())
	{ ?> 
		<div class="post-preview">
			<a href="index.php?action=post&id=<?= $data['id']?>"> 
	            <h2 class="post-title ">
	                <?= htmlspecialchars($data['title']) ?>
	            </h2>

	            <h4 class="post-subtitle d-none d-sm-block">
	            	<?php echo substr( $data['content'], 0, 550).'...'; ?>
	            </h4>

	            <h4 class="post-subtitle d-block d-sm-none">
	            	<?php echo substr( $data['content'], 0, 300).'...'; ?>
	            </h4>

	        </a>
	            <p class="post-meta">
	               Chapitre n° <?= $data['chapter']?>
	               <?php 
	               if(!empty($_SESSION['role']) && $_SESSION['role'] == 'admin' || !empty($_SESSION['role']) && $_SESSION['role'] == 'author'){ ?> 
	           			<a href="index.php?action=update_post&postId=<?= $data['id']?>"> Modification </a> <?php 
	           		}?>
	       		</p>     	
		</div>
		<hr>

	<?php } 
	$posts->closeCursor();	?>

	<div style="text-align: center;"> <?php

	for ($i=1; $i<= $nb_paging_posts; $i++) { ?>

			<a href="index.php?action=listPosts&post_page=<?= $i ?>" class="btn btn-outline-dark"> <?= $i ?> </a> 

	<?php }	?>
	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>