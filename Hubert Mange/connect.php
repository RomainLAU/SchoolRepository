<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include('baseMenu.php');
?>
    <form action="connexion.php" method="POST">
        Identifiant : <input type="text" name="id"><br> 
        Mot de passe : <input type="password" name="password"><br>
        <input type="submit" value="Se connecter">
    </form>

<?php

?>

</body>
<?php

include('footer.php');

?>
</html>