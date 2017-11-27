<?php $title="Modification d'un compte utilisateur"; ?>
<?php ob_start(); 

	if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				echo "Les informations ne sont pas complétes";
			} 
?>

<h1> Modification d'un compte utilisateur </h1>

	<form action="index.php?action=updateUser" method="post">
		<div>
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" />
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