<?php

$dsn = 'mysql:host=database:3306;dbname=bonusesPenalties';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $students = $PDO->query("SELECT * FROM students", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

$addBonus = $_POST;

if (isset($addBonus['addBonus'])) {
    try{
        $statement = $PDO->prepare("UPDATE students SET bonuses = bonuses + 1 WHERE lastname = '" . $addBonus['lastname'] . "'");
        $statement->execute();
    } catch (PDOException $exception) {
        print "Erreur !: " . $exception->getMessage() . "<br>";
        die;
    }
    
    header('location:students.php');

} else {
    header('location:index.php');
}

?>