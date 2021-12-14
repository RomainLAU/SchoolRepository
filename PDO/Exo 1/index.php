<?php

$dsn = 'mysql:host=localhost;dbname=blog';

try{
    $PDO = new PDO($dsn, "root", "");
    $articles = $PDO->query("SELECT * FROM 'article'", PDO::FETCH_ASSOC)->fetchAll();

} catch (PDOException $e) {

    print "Erreur !: " . $e->getMessage() . "<br>";

    die;
}

$statement = $PDO->prepare("UPDATE 'article' set 'title' = :title WHERE id = :id");

$statement->execute([
    'id' => 1,
    'title' => 'HARRY POTTER ET LE RETOUR DES BAGUETTES DE BOIS'
]);

$film = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($film);

?>