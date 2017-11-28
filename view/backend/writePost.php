<?php $title ='Création d\'un chapitre' ;
	$script = ' <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=vhnlap27hf8ot2ip6dmzfw56ndq9anxv230bkh8i9oxmua2q"></script>
  		<script>tinymce.init({ selector:\'textarea\' });</script>'?>

<?php ob_start();
		
		if (!empty($_GET['create']) && $_GET['create'] == 'no'){
				echo "Le chapitre n'a pas pu être ajouté";
			}
		elseif(!empty($_GET['chapter']) && $_GET['chapter'] == 'exist'){
				echo "Le chapitre existe déjà !";
		}
		elseif (!empty($_GET['complete']) && $_GET['complete'] == 'no'){
				echo "Les informations ne sont pas complétes";
			}
		else{}
			?>
	
	<h1> Ecriture d'un chapitre </h1>

	<form action="index.php?action=create_post" method="post">
		<div>
			<label for="title">Titre</label><br />
			<input type="text" id="title" name="title" required />
		</div> <br/>

		<div>
			<label for="chapter">Chapitre n°</label>
			<input type="number" id="chapter" name="chapter" required />
		</div> <br/>

		<div>
			<label for="content">Texte</label><br />
			<textarea id="content" name="content"></textarea>
		</div> <br/>
		<div>
			<input type="submit" />
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>