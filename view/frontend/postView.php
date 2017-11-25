<?php $title = 'Mon Livre !'; ?>

<?php ob_start(); ?>

	
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php');?>

