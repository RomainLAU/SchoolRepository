<?php
include('menu.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIlms</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

$dsn = 'mysql:host=database:3306;dbname=movies';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $movies = $PDO->query("SELECT * FROM movie", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

?>

<div id="research">
    <form action="" method="GET">
        <input type="text" name="titleLike" placeholder="Titre du film">
        <input type="submit" value="Rechercher">
    </form>
    <button><a href="movies.php">Réinitialiser</a></button>
</div>

<?php


if (empty($movies)) {
    echo "<h2>Il n'y a aucun film à afficher...</h2>";
}  else if (isset($_GET['titleLike'])) {
    $matchingMovies = $_GET['titleLike'];
    $movies = $PDO->query("SELECT * FROM movie WHERE title LIKE '%$matchingMovies%'", PDO::FETCH_ASSOC)->fetchAll();
    if (empty($movies)) {
        echo "<h2>Il n'y a aucun film à ce nom..</h2>";
    } else {
        echo "<table border=1>";
        foreach($movies as $movie) {
            echo "<tr>";
            foreach($movie as $key => $value) {
                if ($key !== 'id') {
                    if (strlen($value) > 100) {
                        $valueArray = str_split($value);
                        echo "<td>";
                        for ($chars = 0; $chars < 100; $chars++) {
                            echo $valueArray[$chars];
                        }
                        echo "..";
                        echo "</td>";
                    }
                    else {
                        echo "<td> $value </td>";
                    }
                }
            }
            if (isset($_SESSION['connected']) && $_SESSION['connected'] === True) {
                echo "<td>
                    <form method='POST' action='delete.php'>
                        <input type='text' name='id' value='" . $movie['id'] . "' hidden>
                        <input type='submit' value='Supprimer le film'>
                    </form>
                </td>";
                echo "<td>
                    <form method='GET' action='update.php'>
                        <input type='text' name='id' value='" . $movie['id'] . "' hidden>
                        <input type='submit' value='Editer le film'>
                    </form>
                </td>";
                echo "<td>
                    <form method='GET' action='movieInformation.php'>
                        <input type='text' name='id' value='" . $movie['id'] . "' hidden>
                        <input type='submit' value='Voir les informations du film'>
                    </form>
                </td>";
                echo "</tr>";
            } else {
                echo "<td>
                <form method='GET' action='movieInformation.php'>
                    <input type='text' name='id' value='" . $movie['id'] . "' hidden>
                    <input type='submit' value='Voir les informations du film'>
                </form>
                </td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }

} else {
    echo "<table border=1>";
    foreach($movies as $movie) {
        echo "<tr>";
        foreach($movie as $key => $value) {
            if ($key !== 'id') {
                if (strlen($value) > 100) {
                    $valueArray = str_split($value);
                    echo "<td>";
                    for ($chars = 0; $chars < 100; $chars++) {
                        echo $valueArray[$chars];
                    }
                    echo "..";
                    echo "</td>";
                }
                else {
                    echo "<td> $value </td>";
                }
            }
        }
        if (isset($_SESSION['connected']) && $_SESSION['connected'] === True) {
            echo "<td>
                <form method='POST' action='delete.php'>
                    <input type='text' name='id' value='" . $movie['id'] . "' hidden>
                    <input type='submit' value='Supprimer le film'>
                </form>
            </td>";
            echo "<td>
                <form method='GET' action='update.php'>
                    <input type='text' name='id' value='" . $movie['id'] . "' hidden>
                    <input type='submit' value='Editer le film'>
                </form>
            </td>";
            echo "<td>
                <form method='GET' action='movieInformation.php'>
                    <input type='text' name='id' value='" . $movie['id'] . "' hidden>
                    <input type='submit' value='Voir les informations du film'>
                </form>
            </td>";
            echo "</tr>";
        } else {
            echo "<td>
            <form method='GET' action='movieInformation.php'>
                <input type='text' name='id' value='" . $movie['id'] . "' hidden>
                <input type='submit' value='Voir les informations du film'>
            </form>
            </td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}

include('footer.php');

?>

</body>
</html>