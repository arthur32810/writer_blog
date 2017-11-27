<?php $title="Modification d'un profil"; ?>
<?php ob_start(); 

	if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				echo "Les informations ne sont pas complétes";
			} 
	elseif (!empty($_GET['add']) && $_GET['add'] == 'no'){
			echo "Votre profil n'a pas pu être mis à jour";
		}
?>

<h1> Modification de votre profil utilisateur </h1>

<?php 	if($_SESSION['role'] == 'admin' && !isset($_GET['require_admin'])){ ?>

			<form action="index.php?action=updateUser&require_admin=ok" method="post">
				<div>
					<label for="pseudo">Pseudo</label>
					<input type="text" id="pseudo" name="pseudo" required />
				</div> <br>
				<div>
					<input type="submit" value="Modifier mon compte utilisateur" />
				</div>
			</form> <br>
		<?php }
?>

	<form action="index.php?action=updateUser&require=ok" method="post">
		<div>
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" value="<?= $pseudo?> " required />
		</div>

		<div>
			<label for="pass">Mot de passe Actuel :</label>
			<input type="text" id="pass" name="pass" value="<?= $pass ?>" required/>
		</div>

		<div>
			<label for="newPass">Nouveau mot de passe :</label>
			<input type="text" id="newPass" name="new_pass" />
		</div>

		<div>
			<label for="confirmNewPass">Confirmer le nouveau mot de passe :</label>
			<input type="text" id="confirmNewPass" name="confirmNewPass" />
		</div>

		<div>
			<input type="submit" value="Modifier mon compte utilisateur" />
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>