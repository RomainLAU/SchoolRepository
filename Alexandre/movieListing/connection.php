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
    <title>Se Connecter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="">
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Mot de passe" name="password">
        <input type="submit" name="submit">
    </form>

<?php

if (isset($_SESSION['connected']) && $_SESSION['connected'] === True) {
    header('location: index.php');
}

$_SESSION['connected'] = false;

$dsn = 'mysql:host=database:3306;dbname=movies';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $accounts = $PDO->query("SELECT * FROM user", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$connect = $_POST;

if (isset($connect['submit'])) {
    $statementOfId = $PDO->prepare("SELECT * FROM user WHERE email = :email");
    $statementOfId->execute([
        'email' => $connect['email'],
    ]);
    $idExist = $statementOfId->fetch(PDO::FETCH_ASSOC);
}

if (isset($connect['submit']) && isset($idExist) && !empty($idExist) && !empty($connect['email']) && !empty($connect['password']) && ($idExist['email'] === $connect['email'] && $idExist['password'] === $connect['password'])) {

    $_SESSION['connected'] = True;
    $_SESSION['lastname'] = $idExist['lastname'];
    $_SESSION['firstname'] = $idExist['firstname'];
    header('location:index.php');

} else if (isset($connect['submit']) && isset($idExist) && !empty($idExist) && !empty($connect['email']) && !empty($connect['password']) && ($idExist['email'] !== $connect['email'] || $idExist['password'] !== $connect['password'])) {

    echo "<h4>Au moins un des champs n'est pas correct.</h4>";

} else if (isset($connect['submit']) && (empty($connect['email']) || empty($connect['password']))) {

    echo "<h4>Au moins un des champs n'est pas rempli.</h4>";

}

include('footer.php');

?>

</body>
</html>