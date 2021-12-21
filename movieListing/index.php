<?php
include('menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieLister</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br>
    <h1>Bienvenue sur notre listeur de films.</h1>
    <br>
</body>
</html>

<?php

if (isset($_SESSION['connected']) && $_SESSION['connected'] === True) { ?>
    <form method="POST" action="add.php">
        <input type="text" name="title" placeholder="Titre du film">
        <input type="text" name="synopsis" placeholder="Synopsis du film">
        <input type="text" name="image" placeholder="URL de l'image du film">
        <input type="text" name="trailer_link" placeholder="URL du trailer">
        <input type="submit" name="submit" value="Ajouter le film">
    </form> <?php
} else {
    echo "<h4>Connectez vous pour pouvoir enregistrer de nouveaux films dans notre base de donnée.</h4>";
}

include('footer.php');

?>