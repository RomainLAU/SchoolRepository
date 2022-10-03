<?php

$tab0 = ['Goodbye', 'Dennis'];

$tab1 = ['U', 'DUN', 'GOOFED'];

$tab2 = ['name'=>'Glenn','first_name'=>'kenny','pets'=>'dusty','crime'=>'animal abuse','achievement'=>'goofed'];

$tab3 = ['bananas', 'apple','fish'=>'sharktopus', 'lemon', 'pineapple', 'pear', 'cherry'];

$tab4 = ['x-men', 'spiderman','great saiyaman','iron man','superman', 'batman','wolverine', 'hulk'];


function pilf($tab) {
	$noKeyTab = [];
	foreach($tab as $key => $value) {
		array_push($noKeyTab, $value);
	}
	$size = sizeof($tab);
	$newTab = [];
	for($i=$size-1; $i>=0; $i--){
		array_push($newTab, $noKeyTab[$i]);
	}
	foreach($newTab as $key => $value) {
		$sortingTab = [];
		$sortingTab = str_split($value);
		$size2 = sizeof($sortingTab);
		for($i=$size2-1; $i>=0; $i--){
			echo("$sortingTab[$i]");
		}
		echo("<br>");
	}
}

pilf($tab3);

?>