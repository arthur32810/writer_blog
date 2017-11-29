<?php $title="Modification d'un profil"; ?>
<?php ob_start(); 

	if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				echo "Les informations ne sont pas complétes";
			} 
	elseif (!empty($_GET['add']) && $_GET['add'] == 'no'){
			echo "Votre profil n'a pas pu être mis à jour";
		}
	elseif (!empty($_GET['deleteUser']) && $_GET['deleteUser'] == 'no'){
			echo "Votre profil n'a pas pu être supprimé";
		}
?>

<h1> Modification de votre profil utilisateur </h1>

<?php 	if($_SESSION['role'] == 'admin' && !isset($_GET['require_admin'])){ ?>

			<form action="index.php?action=updateUser&require_admin=ok" method="post">
				<div>
					<label for="pseudo">Pseudo</label>
					<input type="text" id="pseudo" name="pseudoSearch" required />
				</div> <br>
				<div>
					<input type="submit" value="Modifier mon compte utilisateur" />
				</div>
			</form> <br>
		<?php }

	if(isset($_GET['require_admin']) || $_SESSION['role']!='admin'){
?>
	<form action="index.php?action=updateUser&require=ok" method="post">
		<div>
			<label for="pseudo">Pseudo</label>
			<input type="text" id="pseudo" name="pseudo" value="<?= $pseudo?> " required />
		</div>

		<div>
			<label for="pass">Mot de passe Actuel :</label>
			<input type="password" id="pass" name="pass" value="<?= $pass ?>" required/>
		</div>

		<div>
			<label for="newPass">Nouveau mot de passe :</label>
			<input type="password" id="newPass" name="new_pass" />
		</div>

		<div>
			<label for="confirmNewPass">Confirmer le nouveau mot de passe :</label>
			<input type="password" id="confirmNewPass" name="confirmNewPass" />
		</div>
<?php
		if($_SESSION['role'] == 'admin'){ ?>
			<div>
				<label for="role">Role de l'utilisateur : </label>
			       	<select name="role" id="role">
			       		<option value="view">Lecteur</option>
			            <option value="admin">Administrateur</option>
			            <option value="author">Auteur</option>
			            <option value="moderator"> Moderateur </option>
			       </select>
			</div>
	<?php } ?>

		<input hidden name="id" value="<?= $user['id']?>" />

		<div>
			<input type="submit" value="Modifier mon compte utilisateur" name="update" />
			<input type="submit" value="Supprimer mon compte utilisateur" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre profil, vous ne pourrez plus modifier vos commentaires !')" />
		</div>
	</form>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>