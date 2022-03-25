<?php

$tab0 = ['Goodbye', 'Dennis'];

$tab1 = ['U', 'DUN', 'GOOFED'];

$tab2 = ['name'=>'Glenn','first_name'=>'kenny','pets'=>'dusty','crime'=>'animal abuse','achievement'=>'goofed'];

$tab3 = ['bananas', 'apple','fish'=>'sharktopus', 'lemon', 'pineapple', 'pear', 'cherry'];

$tab4 = ['x-men', 'spiderman','great saiyaman','iron man','superman', 'batman','wolverine', 'hulk'];

function mysupercount($tab) {
	$nb = 0;
	foreach($tab as $key => $value) {
		$wordChecking = str_split($value);
		echo($wordChecking);
		echo("<br>");
		foreach($wordChecking as $word => $letters) {
			$nb++;
		}
	}
	echo($nb);
}

mysupercount($tab2);

?>