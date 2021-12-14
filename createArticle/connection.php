<?php
session_start();

$_SESSION['connected'] = false;

$dsn = 'mysql:host=database:3306;dbname=article';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $accounts = $PDO->query("SELECT * FROM connexion", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$connect = $_POST;

if (isset($connect['submit'])) {
    $statementOfId = $PDO->prepare("SELECT * FROM connexion WHERE identifiant = :identifiant");
    $statementOfId->execute([
        'identifiant' => $connect['identifiant'],
    ]);
    $idExist = $statementOfId->fetch(PDO::FETCH_ASSOC);
}

if (isset($connect['submit']) && isset($idExist) && ($idExist['identifiant'] === $connect['identifiant'] && $idExist['password'] === $connect['password'])) {
    $_SESSION['connected'] = True;
    header('location:index.php');

} else if (isset($connect['submit']) && isset($idExist) && ($idExist['identifiant'] !== $connect['identifiant'] || $idExist['password'] !== $connect['password'])) {

    echo "L'identifiant n'existe pas ou le mot de passe n'est pas correct. <br><br>";
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
        <input type="text" placeholder="Identifiant" name="identifiant">
        <input type="password" placeholder="Mot de passe" name="password">
        <input type="submit" name="submit">
    </form>
</body>
</html>