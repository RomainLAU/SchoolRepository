<?php
ob_start();
include('menu.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'enregistrer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

if (isset($_SESSION['connected']) && $_SESSION['connected'] === True) {
    header('location: index.php');
}

$dsn = 'mysql:host=database:3306;dbname=movies';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $users = $PDO->query("SELECT * FROM user", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$addId = $_POST;
$idIsFull = True;

foreach ($addId as $values => $value) {
    $chars = str_split($value);
    if (empty($value) || $value === '') {
        $idIsFull = False;
    }
    foreach ($chars as $char) {
        if ($char === ' ') {
            $idIsFull = False;
        }
    }
}

if (isset($addId['submit'])) {
    $statementOfId = $PDO->prepare("SELECT * FROM user WHERE email = :email");
    $statementOfId->execute([
        'email' => $addId['email'],
    ]);
    $idExist = $statementOfId->fetch(PDO::FETCH_ASSOC);
}

if (isset($idExist) && $idExist === false && isset($addId['submit']) && $idIsFull === True) {

    $statement = $PDO->prepare("INSERT INTO user (lastname, firstname, email, password) VALUES (:lastname, :firstname, :email, :password)");

    $statement->execute([
        'lastname' => $addId['lastname'],
        'firstname' => $addId['firstname'],
        'email' => $addId['email'],
        'password' => $addId['password'],
    ]);
    echo "<h4>Compte créé.</h4>";

} else if (isset($idExist) && $idExist !== false && isset($addId['submit']) && $idIsFull === True) {
    echo "<h4>L'email existe déjà, s'il vous appartient, essayez de vous connecter.</h4>";
} else if (isset($addId['submit']) && $idIsFull === False) {
    echo "<h4>Les champs ne sont pas complets ou invalides, remplissez les et réessayez.</h4>";
}

?>
    <form method="POST" action="">
    <input type="text" placeholder="Nom" name="lastname">
    <input type="text" placeholder="Prénom" name="firstname">
        <input type="text" placeholder="Email" name="email">
        <input type="password" placeholder="Mot de passe" name="password">
        <input type="submit" name="submit">
    </form>
</body>
</html>

<?php

include('footer.php');

?>