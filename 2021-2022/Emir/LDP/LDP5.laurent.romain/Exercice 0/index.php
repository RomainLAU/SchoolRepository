<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</body>
</html>

<?php

if (isset($_GET['password']) && $_GET['password'] == 'jesuisunmotdepassesécurisé') {
    echo 'bienvenue sur ma page secrète';
} else { ?>
    <form action="" method="GET">
        <label for="password">Mot de passe</label>
        <input type="password" name="password">
        <input type="submit">
    </form>

<?php

}

?>