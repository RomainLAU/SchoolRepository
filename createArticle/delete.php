<?php

$dsn = 'mysql:host=database:3306;dbname=article';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $articles = $PDO->query("SELECT * FROM article", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$deleteForm = $_POST;

$statement = $PDO->prepare("DELETE article FROM article WHERE id = :id");

$statement->execute([
    'id' => $deleteForm['id'],
]);

header('location:articles.php');


$lol = 15

?>