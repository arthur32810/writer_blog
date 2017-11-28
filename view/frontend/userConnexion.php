<?php $title="Connexion" ?>
<?php ob_start(); 

	if (!empty($_GET['add']) && $_GET['add'] == 'yes'){
			echo "Vous avez bien été inscrit(e)";
		}
	elseif (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
			echo "pseudo ou mot de passe non présent";
		}
?>

<h1> Connection à votre profil </h1>

	<form action="index.php?action=connection" method="post">
		<div>
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" value="<?= $pseudo ?>" required />
		</div>

		<div>
			<label for="pass">Mot de passe :</label>
			<input type="password" id="pass" name="pass" value="<?= $pass ?>" required />
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