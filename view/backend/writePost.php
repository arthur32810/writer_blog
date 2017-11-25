<?php $title ='Création d\'un chapitre' ;
	$script = ' <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  		<script>tinymce.init({ selector:\'textarea\' });</script>'?>

<?php ob_start(); ?>
	
	<h1> Ecriture d'un chapitre </h1>

	<form action="index.php?action=create_post" method="post">
		<div>
			<label for="author">Titre</label><br />
			<input type="text" id="author" name="author" />
		</div> <br/>
		<div>
			<label for="comment">Texte</label><br />
			<textarea id="comment" name="comment"></textarea>
		</div> <br/>
		<div>
			<input type="submit" />
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>