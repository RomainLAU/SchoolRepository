<?php

$json = file_get_contents("pokedex.json");

$jsonDecode = json_decode($json, true);

$form = $_GET;

foreach($jsonDecode as $key => $pokemon) {
	if (ucfirst($pokemon['name']['french']) == ucfirst($form['pokemonName'])) {
		echo ("Nom = " . $pokemon['name']['french'] . "<br>");
		foreach ($pokemon['type'] as $type) {
		echo($type);
		}
		foreach ($pokemon['base'] as $key => $stats) {
			echo ($key . " = " . $stats . "<br>");
		}
		if ($pokemon['id'] < 10) {
			echo("<img src='https://raw.githubusercontent.com/fanzeyi/pokemon.json/master/images/00" . $pokemon['id'] . ".png'>");
		} else if ($pokemon['id'] < 100) {
			echo("<img src='https://raw.githubusercontent.com/fanzeyi/pokemon.json/master/images/0" . $pokemon['id'] . ".png'>");
		} else {
			echo("<img src='https://raw.githubusercontent.com/fanzeyi/pokemon.json/master/images/" . $pokemon['id'] . ".png'>");
		}
	} 
	if (in_array(ucfirst($form['pokemonName']), $pokemon['type']) == ucfirst($form['pokemonName'])) {
		echo ("Nom = " . $pokemon['name']['french'] . "<br>");
		foreach ($pokemon['type'] as $type) {
			echo $type;
		}
		foreach ($pokemon['base'] as $key => $stats) {
			echo ($key . " = " . $stats . "<br>");
		}
		if ($pokemon['id'] < 10) {
			echo("<img src='https://raw.githubusercontent.com/fanzeyi/pokemon.json/master/images/00" . $pokemon['id'] . ".png'>");
		} else if ($pokemon['id'] < 100) {
			echo("<img src='https://raw.githubusercontent.com/fanzeyi/pokemon.json/master/images/0" . $pokemon['id'] . ".png'>");
		} else {
			echo("<img src='https://raw.githubusercontent.com/fanzeyi/pokemon.json/master/images/" . $pokemon['id'] . ".png'>");
		}
	}
}

?>