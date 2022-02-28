<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="asset/style/style.css">
</head>
<body id='students-body'>

<?php

$dsn = 'mysql:host=database:3306;dbname=bonusesPenalties';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $students = $PDO->query("SELECT * FROM students", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

?>

<div id="research">
    <form action="" method="GET">
        <input type="text" name="firstnameLike" placeholder="Student's firstname">
        <input type="submit" value="Find">
    </form>
    <button><a href="students.php">Reinitialize</a></button>
</div>

<?php

if (empty($students)) {
    echo "<h2>No student to display...</h2>";
}  else if (isset($_GET['firstnameLike'])) {
    $matchingstudents = $_GET['firstnameLike'];
    $students = $PDO->query("SELECT * FROM students WHERE firstname LIKE '%$matchingstudents%'", PDO::FETCH_ASSOC)->fetchAll();
    if (empty($students)) {
        echo "<h2>No student to display with this firstname..</h2>";
    } else {
        echo "<table>";
        foreach($students as $student) {
            echo "<tr>";
            foreach($student as $key => $value) {
                if ($key !== 'id') {
                    if (strlen($value) > 100) {
                        $valueArray = str_split($value);
                        echo "<td>";
                        for ($chars = 0; $chars < 100; $chars++) {
                            echo $valueArray[$chars];
                        }
                        echo "..";
                        echo "</td>";
                    } else if ($key == 'bonuses') {
                        echo "<td id='bonuses' style='border-right: none;'>" . $value;
                    } else if ($key == 'penalties') {
                        echo "<td id='penalties' style='border-left: none;'>" . $value . "</td>";
                    } else {
                        echo "<td> $value </td>";
                    }
                }
            }
            echo "<td class='bonus'>
                <form method='POST' action='addBonus.php'>
                    <input type='text' name='lastname' value='" . $student['lastname'] . "' hidden>
                    <input type='submit' value='Add a bonus' name='addBonus'>
                </form>
            </td>";
            echo "<td class='penalty'>
                <form method='POST' action='addPenalty.php'>
                    <input type='text' name='lastname' value='" . $student['lastname'] . "' hidden>
                    <input type='submit' value='Add a penalty' name='addPenalty'>
                </form>
            </td>";
            echo "<td class='update'>
                <form method='GET' action='update.php'>
                    <input type='text' name='lastname' value='" . $student['lastname'] . "' hidden>
                    <input type='submit' value='Edit bonuses and penalties' name='update'>
                </form>
            </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

} else {
    echo "<table>";
    foreach($students as $student) {
        echo "<tr>";
        foreach($student as $key => $value) {
            if ($key !== 'id') {
                if (strlen($value) > 100) {
                    $valueArray = str_split($value);
                    echo "<td>";
                    for ($chars = 0; $chars < 100; $chars++) {
                        echo $valueArray[$chars];
                    }
                    echo "..";
                    echo "</td>";
                } else if ($key == 'bonuses') {
                    echo "<td id='bonuses' style='border-right: none;'>" . $value;
                } else if ($key == 'penalties') {
                    echo "<td id='penalties' style='border-left: none;'>" . $value . "</td>";
                } else {
                    echo "<td> $value </td>";
                }
            }
        }
        echo "<td class='bonus'>
            <form method='POST' action='addBonus.php'>
                <input type='text' name='lastname' value='" . $student['lastname'] . "' hidden>
                <input type='submit' value='Add a bonus' name='addBonus'>
            </form>
        </td>";
        echo "<td class='penalty'>
            <form method='POST' action='addPenalty.php'>
                <input type='text' name='lastname' value='" . $student['lastname'] . "' hidden>
                <input type='submit' value='Add a penalty' name='addPenalty'>
            </form>
        </td>";
        echo "<td class='update'>
            <form method='GET' action='update.php'>
                <input type='text' name='lastname' value='" . $student['lastname'] . "' hidden>
                <input type='submit' value='Edit bonuses and penalties' name='update'>
            </form>
        </td>";
        echo "</tr>";
    }
    echo "</table>";
}

?>

</body>
</html>