<?php
ob_start();
include('menu.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations sur le film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

$dsn = 'mysql:host=database:3306;dbname=movies';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $movies = $PDO->query("SELECT * FROM movie WHERE id = ". $_GET['id'], PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

echo "<br><table border=1>";
echo "<tr>";
foreach($movies[0] as $infos => $info) {
    if ($infos !== 'id') {
        if (strlen($info) > 100) {
            $infoArray = str_split($info);
            echo "<td>";
            for ($chars = 0; $chars < 100; $chars++) {
                echo $infoArray[$chars];
            }
            echo "..";
            echo "</td>";
        }
        else if ($infos === 'trailer_link') {
            continue;
        } else {
            echo "<td> $info </td>";
        }
    }
}
echo "</tr>";
echo "</table>";

$trailerURL = $movies[0]['trailer_link'];

function urlCleaner($trailerURL) {
	if (!empty($trailerURL)) {
		$cleanURL = str_replace('youtu.be/', 'www.youtube.com/embed/', $trailerURL);
		$cleanURL = str_replace('www.youtube.com/watch?v=', 'www.youtube.com/embed/', $trailerURL);
	}
	return $cleanURL;
};

echo "<iframe width='560' height='315' src='" . urlCleaner($trailerURL) . "' frameborder='0' encrypted-media allowfullscreen></iframe>";

include('footer.php');

?>

</body>
</html>