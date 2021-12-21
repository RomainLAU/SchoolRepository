<?php

$dsn = 'mysql:host=database:3306;dbname=movies';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $articles = $PDO->query("SELECT * FROM movie", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$addForm = $_POST;
$movieIsFull = True;

foreach ($addForm as $values => $value) {
    if (empty($value) || $value === '') {
        $movieIsFull = False;
    }
}

if (isset($addForm['submit']) && $movieIsFull === True) {
    $statement = $PDO->prepare("INSERT INTO movie (title, synopsis, image, trailer_link) VALUES (:title, :synopsis, :image, :trailer_link)");

    $statement->execute([
        'title' => $addForm['title'],
        'synopsis' => $addForm['synopsis'],
        'image' => $addForm['image'],
        'trailer_link' => $addForm['trailer_link'],
    ]);
    header('location:movies.php');
} else {
    header('location:index.php');
}

?>