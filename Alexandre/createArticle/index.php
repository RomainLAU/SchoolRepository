<?php
include('menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
    
    <form method="POST" action="add.php">
        <input type="text" name="title" placeholder="Titre de l'article">
        <input type="text" name="description" placeholder="Description de l'article">
        <input type="text" name="url" placeholder="URL de l'image de couverture">
        <input type="submit">
    </form>
<br>
<a href="articles.php">Voir les articles</a>
<br>
<br>



</body>
</html>