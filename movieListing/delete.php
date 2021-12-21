<?php

$dsn = 'mysql:host=database:3306;dbname=movies';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $articles = $PDO->query("SELECT * FROM movie", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$deleteForm = $_POST;

$statement = $PDO->prepare("DELETE movie FROM movie WHERE id = :id");

$statement->execute([
    'id' => $deleteForm['id'],
]);

header('location:movies.php');

?>