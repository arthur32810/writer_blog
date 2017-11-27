<?php $title="Création d'un compte utilisateur" ?>
<?php ob_start(); ?>

<h1> Création d'un compte utilisateur </h1>

	<form action="index.php?action=connection" method="post">
		<div>
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo"/>
		</div>

		<div>
			<label for="pass">Mot de passe :</label>
			<input type="text" id="pass" name="pass" />
		</div>

		<div>
			<input type="submit" />
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>