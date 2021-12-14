<?php

$dsn = 'mysql:host=database:3306;dbname=movies';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $articles = $PDO->query("SELECT * FROM movies", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$addForm = $_POST;

$statement = $PDO->prepare("INSERT INTO movies (title, synopsis, image, trailer_link) VALUES (:title, :synopsis, :image, :trailer_link)");

$statement->execute([
    'title' => $addForm['title'],
    'synopsis' => $addForm['synopsis'],
    'image' => $addForm['image'],
    'trailer_link' => $addForm['trailer'],
]);

header('location:movies.php');

?>