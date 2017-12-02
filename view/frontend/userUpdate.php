<?php $title="Modification d'un profil"; ?>
<?php ob_start(); 

	if (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Les informations ne sont pas complétes
				</div> <?php
			} 
	elseif (!empty($_GET['add']) && $_GET['add'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Votre profil n'a pas pu être mis à jour
				</div> <?php
		}
	elseif (!empty($_GET['deleteUser']) && $_GET['deleteUser'] == 'no'){
				?><div class="alert alert-danger" role="alert">
					Votre profil n'a pas pu être supprimé
				</div> <?php
		}
	elseif (!empty($_GET['pseudo']) && $_GET['pseudo'] == 'exist'){
			?><div class="alert alert-danger" role="alert">
					Le pseudo choisi existe déjà
				</div> <?php
	}
	elseif($_SESSION['role'] == 'admin' && !empty($_GET['pseudo']) && $_GET['pseudo'] == 'no-exist') {
			?><div class="alert alert-danger" role="alert">
					Le pseudo choisi n'existe pas
			</div> <?php
	}

?>

<h1> Modification de votre profil utilisateur </h1>

<?php 	if($_SESSION['role'] == 'admin' && !isset($_GET['require_admin'])){ ?>

			<form action="index.php?action=updateUser&require_admin=ok" method="post">
				<div>
					<label class="col-form-label" for="pseudo">Pseudo</label>
					<input class="form-control" type="text" id="pseudo" name="pseudoSearch" required />
				</div> <br>
				<div>
					<input class="btn btn-primary" type="submit" value="Modifier mon compte utilisateur" />
				</div>
			</form> <br>
		<?php }

	if(isset($_GET['require_admin']) || $_SESSION['role']!='admin'){
?>
	<form action="index.php?action=updateUser&require=ok" method="post">
		<div>
			<label class="col-form-label" for="pseudo">Pseudo* </label>
			<input type="text" class="form-control" id="pseudo" name="pseudo" value="<?= $pseudo?> " required />
		</div>

		<div>
			<label class="col-form-label" for="pass">Mot de passe Actuel* </label>
			<input type="password" class="form-control" id="pass" name="pass" value="<?= $pass ?>" required/>
		</div>

		<div>
			<label class="col-form-label" for="newPass">Nouveau mot de passe </label>
			<input type="password" class="form-control" id="newPass" name="new_pass" />
		</div>

		<div>
			<label class="col-form-label" for="confirmNewPass">Confirmer le nouveau mot de passe </label>
			<input type="password" class="form-control" id="confirmNewPass" name="confirmNewPass" />
		</div> 
<?php
		if($_SESSION['role'] == 'admin'){ ?>
			<br/>
			<div>
				<label for="role">Role de l'utilisateur </label>
			       	<select class="form-control" name="role" id="role" required >
			       		<option value="view" <?php if($user['role'] == 'view') {?> selected <?php } ?> >Lecteur</option>
			            <option value="admin" <?php if($user['role'] == 'admin') {?> selected <?php } ?> >Administrateur</option>
			            <option value="author" <?php if($user['role'] == 'author') {?> selected <?php } ?> >Auteur</option>
			            <option value="moderator" <?php if($user['role'] == 'moderator') {?> selected <?php } ?>> Moderateur </option>
			       </select>
			</div>
	<?php } ?>

		<input hidden name="id" value="<?= $user['id']?>" /> <br/>

		<div>
			<input class="btn btn-primary" type="submit" value="Modifier mon compte utilisateur" name="update" />
			<input class="btn btn-danger" type="submit" value="Supprimer mon compte utilisateur" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre profil, vous ne pourrez plus modifier vos commentaires !')" />
		</div>
	</form>
<?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>