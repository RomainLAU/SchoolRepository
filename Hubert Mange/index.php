<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubert Mange</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include('baseMenu.php');

?>
<?php

include('dishes.php');

?>
 
    <form action="recap.php" method="POST">
        <select name="dish">
            <option value="">Select a dish</option>
            <option value="0">Hamburger - 12€/le plat</option>
            <option value="1">Sushi - 15€/le plat</option>
            <option value="2">Kebab - 6€/le plat</option>
            <option value="3">Paella - 20€/le plat</option>
        </select>
        <br><br>
        <label for="quantity">Combien en voulez-vous ?</label>
        <input type="number" name="quantity" id="quantity" min="1" max="12"> <br><br>
        <input type="submit" value="Commander">
    </form>



</body>
<?php

include('footer.php');

?>
</html>