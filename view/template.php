<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <?php if(!empty($script)){ echo $script;} ?>
    </head>
        
    <body>

        <section class="col-xs-offset-2 col-xs-8 col-xs-offset-2">
            <?= $content ?>
        </section>
    </body>
</html>