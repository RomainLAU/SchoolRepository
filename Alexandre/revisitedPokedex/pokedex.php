<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<?php

$json = file_get_contents("pokedex.json");

$jsonDecode = json_decode($json, true);

$form = $_GET;

echo "<div class='checkerboard'>";

foreach($jsonDecode as $key => $pokemon) {
	echo "<div>";
	if ($pokemon['id'] < 10) {
		echo("<img src='https://raw.githubusercontent.com/fanzeyi/pokemon.json/master/images/00" . $pokemon['id'] . ".png'>");
	} else if ($pokemon['id'] < 100) {
		echo("<img src='https://raw.githubusercontent.com/fanzeyi/pokemon.json/master/images/0" . $pokemon['id'] . ".png'>");
	} else {
		echo("<img src='https://raw.githubusercontent.com/fanzeyi/pokemon.json/master/images/" . $pokemon['id'] . ".png'>");
	}
	echo "<style>
		.checkerboard>div:hover:after{
			height: 100%;
			background-color: argb(0, 0, 0, 0.3);
			content: " . $pokemon['name']['french'] . ";
			display: flex;
			justify-content: center;
			align-items: center;
		}
	</style>";
	echo "</div>";
}

echo "</div>";

?>
</body>
</html>