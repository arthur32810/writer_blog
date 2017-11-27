<?php $title="Création d'un compte utilisateur"; ?>
<?php ob_start(); 

	if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				echo "Les informations ne sont pas complétes";
			} 
	elseif (!empty($_GET['user']) && $_GET['user'] == 'exist'){
			echo "Pseudo déjà utilisé";
		}
	elseif (!empty($_GET['add']) && $_GET['add'] == 'no'){
			echo "Vous n'avez pu été inscrit(e), veuillez réessayer";
		}
?>

<h1> Création d'un compte utilisateur </h1>

	<form action="index.php?action=addUser" method="post">
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