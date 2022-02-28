<?php

$dsn = 'mysql:host=database:3306;dbname=bonusesPenalties';

$updateForm = $_GET;

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $students = $PDO->query("SELECT * FROM students WHERE lastname = '" . $updateForm['lastname'] . "'", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}


if (isset($_POST['update'])) {
    $statement = $PDO->prepare("UPDATE students SET bonuses = :bonuses, penalties = :penalties WHERE lastname = '" . $updateForm['lastname'] . "'");

    $statement->execute([
        'bonuses' => $_POST['bonuses'],
        'penalties' => $_POST['penalties']
    ]);

    header('location:students.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edition of bonuses and penalities</title>
    <link rel="stylesheet" href="asset/style/style.css">
</head>
<body id="updateBody">
    <?php echo "<p>Bonuses and Maluses of<br>" . $students[0]['firstname'] . " " . $students[0]['lastname'] . "</p>";?>
    <form method="POST" action="" id="updateForm">
        <input type="text" value="<?php echo $students[0]['lastname'];?>" name="lastname" hidden>
        <label for="bonuses">Bonuses: </label>
        <input type="number" value="<?php echo $students[0]['bonuses'];?>" name="bonuses" id="bonuses">
        <label for="penalties">Penalties: </label>
        <input type="number" value="<?php echo $students[0]['penalties'];?>" name="penalties" id="penalties">
        <input type="submit" value="Edit" name="update">
    </form>
</body>
</html>