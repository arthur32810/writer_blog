<?php $title="Connexion" ?>
<?php ob_start(); ?>

	<form action="index.php?action=connection" method="post">
		<div>
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" value="<?= $pseudo ?>"/>
		</div>

		<div>
			<label for="pass">Mot de passe :</label>
			<input type="text" id="pass" name="pass" value="<?= $pass ?>" />
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