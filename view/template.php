<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
        <?php if(!empty($script)){ echo $script;} ?>
    </head>
        
    <body>
        <?= $content ?>
    </body>
</html>