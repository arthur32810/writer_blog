<?php $title = 'Mon Livre !'; ?>

<?php ob_start(); ?>

	<h1> <?= htmlspecialchars($post['title']) ?> </h1>

	<a href="index.php?action=listPosts"> Revenir à l'index </a>
	

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>

