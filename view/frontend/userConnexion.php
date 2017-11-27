<?php $title="Connexion" ?>
<?php ob_start(); 

	if (!empty($_GET['add']) && $_GET['add'] == 'yes'){
			echo "Vous avez bien été inscrit(e)";
		}
?>

<h1> Connection à votre profil </h1>

	<form action="index.php?action=connection" method="post">
		<div>
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" value="<?= $pseudo ?>"/>
		</div>

		<div>
			<label for="pass">Mot de passe :</label>
			<input type="password" id="pass" name="pass" value="<?= $pass ?>" />
		</div>

		<div>
			<label for="cookie">Maintenir la connexion</label>
			<input type="checkbox" id="cookie" name="cookie" />
		</div>

		<div>
			<input type="submit" />
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>