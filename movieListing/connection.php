<?php
session_start();

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

if (isset($connect['submit']) && isset($idExist) && ($idExist['email'] === $connect['email'] && $idExist['password'] === $connect['password'])) {
    $_SESSION['connected'] = True;
    header('location:index.php');

} else if (isset($connect['submit']) && isset($idExist) && ($idExist['email'] !== $connect['email'] || $idExist['password'] !== $connect['password'])) {

    echo "L'email n'existe pas ou le mot de passe n'est pas correct. <br><br>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se Connecter</title>
</head>
<body>
    <form method="POST" action="">
        <input type="email" placeholder="Email" name="email">
        <input type="password" placeholder="Mot de passe" name="password">
        <input type="submit" name="submit">
    </form>
</body>
</html>