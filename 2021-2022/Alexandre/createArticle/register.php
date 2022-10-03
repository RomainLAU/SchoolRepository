<?php

$dsn = 'mysql:host=database:3306;dbname=article';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $accounts = $PDO->query("SELECT * FROM connexion", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$addId = $_POST;

if (isset($addId['submit'])) {
    $statementOfId = $PDO->prepare("SELECT * FROM connexion WHERE identifiant = :identifiant");
    $statementOfId->execute([
        'identifiant' => $addId['identifiant'],
    ]);
    $idExist = $statementOfId->fetch(PDO::FETCH_ASSOC);
    var_dump($idExist);
}

if (isset($idExist) && $idExist === false && isset($addId['submit'])) {

    $statement = $PDO->prepare("INSERT INTO connexion (identifiant, password) VALUES (:identifiant, :password)");

    $statement->execute([
        'identifiant' => $addId['identifiant'],
        'password' => $addId['password'],
    ]);
    echo "Compte créé <br>";

} else if (isset($idExist) && $idExist !== false && isset($addId['submit'])) {
    echo "L'identifiant existe déjà, s'il vous appartient, essayez de vous connecter. <br><br>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'enregistrer</title>
</head>
<body>
    <form method="POST" action="">
        <input type="text" placeholder="Identifiant" name="identifiant">
        <input type="password" placeholder="Mot de passe" name="password">
        <input type="submit" name="submit">
    </form>

    <a href="connection.php">Se connecter</a>
</body>
</html>