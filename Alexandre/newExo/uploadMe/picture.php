<?php

$pictureId = substr($_SERVER['REQUEST_URI'], 50);

try{
    $PDO = new PDO('mysql:host=database:3306;dbname=imageDB', "root", "tiger");
    $file = $PDO->query('SELECT * FROM images WHERE id = ' . $pictureId, PDO::FETCH_ASSOC)->fetch();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

echo "<h1>" . $file['title'] . "</h1>";
echo "<img src='/files/" . $file['image_name'] . "'>";