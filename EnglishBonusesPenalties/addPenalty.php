<?php

$dsn = 'mysql:host=database:3306;dbname=bonusesPenalties';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $students = $PDO->query("SELECT * FROM students", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$addPenalty = $_POST;

if (isset($addPenalty['addPenalty'])) {
    $statement = $PDO->prepare("UPDATE students SET penalties = penalties + 1 WHERE lastname = '" . $addPenalty['lastname'] . "'");

    $statement->execute([]);
    header('location:students.php');
} else {
    header('location:index.php');
}

?>