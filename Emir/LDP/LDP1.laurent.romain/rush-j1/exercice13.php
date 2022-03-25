<?php

$title = "Mon titre de page";
$link = '"http://google.fr"';
$linkname = "Google";

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>
            <?php echo($title) ?>
        </title>
    </head>
    <body>
        <h3>
            <?php echo($title) ?>
        </h3>
        <p>PHP (officiellement, ce sigle est un acronyme récursif pour PHP Hypertext Preprocessor) est un langage de scripts généraliste et Open Source, spécialement conçu pour le développement d'applications web. Il peut être intégré facilement au HTML. </p>
        <p>
            <a href=<?php echo($link) ?>>
                <?php echo($linkname) ?>
            </a>
        </p>
</body>
</html>