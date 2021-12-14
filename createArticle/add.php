<?php

$dsn = 'mysql:host=database:3306;dbname=article';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $articles = $PDO->query("SELECT * FROM article", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$addForm = $_POST;

$statement = $PDO->prepare("INSERT INTO article (titre, description, url) VALUES (:titre, :description, :url)");

$statement->execute([
    'titre' => $addForm['title'],
    'description' => $addForm['description'],
    'url' => $addForm['url'],
]);

header('location:articles.php');

?>