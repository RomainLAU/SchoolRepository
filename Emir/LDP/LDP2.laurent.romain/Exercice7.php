<?php

$tab0 = ['Goodbye', 'Dennis'];

$tab1 = ['U', 'DUN', 'GOOFED'];

$tab2 = ['name'=>'Glenn','first_name'=>'kenny','pets'=>'dusty','crime'=>'animal abuse','achievement'=>'goofed'];

$tab3 = ['bananas', 'apple','fish'=>'sharktopus', 'lemon', 'pineapple', 'pear', 'cherry'];

$tab4 = ['x-men', 'spiderman','great saiyaman','iron man','superman', 'batman','wolverine', 'hulk'];

function mycount($tab) {
	$keyNb = 0;
	foreach ($tab as $keys => $values) {
		$keyNb++;
	}
	echo($keyNb);
}

mycount($tab0);

?>