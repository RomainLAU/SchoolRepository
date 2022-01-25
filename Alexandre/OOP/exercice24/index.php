<?php

include_once('UserManager.php');

$dsn = 'mysql:host=database:3306;dbname=oop_exercise';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $books = $PDO->query("SELECT * FROM user", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

?>