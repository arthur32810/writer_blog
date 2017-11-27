<?php $title ='Modification d\'un chapitre' ;
	$script = ' <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=vhnlap27hf8ot2ip6dmzfw56ndq9anxv230bkh8i9oxmua2q"></script>
  		<script>tinymce.init({ selector:\'textarea\' });</script>'?>

<?php ob_start();
		
		/*if (!empty($_GET['create'])){
			if ($_GET['create'] == 'yes'){
				echo "Le Chapitre à été ajouté";
			}
			elseif($_GET['create'] == 'no'){
				echo "Le chapitre n'a pas pu être ajouté";
			}
		}
		elseif (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				echo "Les informations ne sont pas complétes";
			}
		else{}*/
			?>
		
		
		
	
	<h1> Modification du chapitre <?= $post['chapter'] ?> : <?= $post['title']?>  </h1>

	<form action="index.php?action=modif_post" method="post">
		<div>
			<label for="title">Titre</label>
			<input type="text" id="title" name="title" value="<?= $post['title']?>" /> <br/>
		</div> <br/>

		<div>
			<label for="chapter">Chapitre n°</label>
			<input type="number" id="chapter" name="chapter" value="<?= $post['chapter']?>" />
		</div> <br/>

		<div>
			<label for="content">Texte</label><br />
			<textarea id="content" name="content"> <?= $post['content']?></textarea>
		</div> <br/>

		<div>
			<input type="submit" value="Modifier" name="update" onclick="return confirm('Êtes-vous sûr de vouloir modifer ce chapitre ?')"/>
			<input type="submit" value="Supprimer" name="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce chapitre ?')"/>
			
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>