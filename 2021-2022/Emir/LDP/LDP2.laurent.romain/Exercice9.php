<?php

$tab0 = ['Goodbye', 'Dennis'];

$tab1 = ['U', 'DUN', 'GOOFED'];

$tab2 = ['name'=>'Glenn','first_name'=>'kenny','pets'=>'dusty','crime'=>'animal abuse','achievement'=>'goofed'];

$tab3 = ['bananas', 'apple','fish'=>'sharktopus', 'lemon', 'pineapple', 'pear', 'cherry'];

$tab4 = ['x-men', 'spiderman','great saiyaman','iron man','superman', 'batman','wolverine', 'hulk'];

// Je dois calculer la taille de chaque value du tab
// Je dois calculer la taille de chaque value du tab 
//  	Puis comparer chaque taille entre elle :
// 			Si value 1 > value 2 -> faire : value 1 > 3, etc...

function mysupercount($tab) {
	$nb = 0;
	$keyBiggerValue = 0;
	foreach($tab as $key => $value) {
		$size = 0;
		$wordChecking = str_split($value);
		foreach($wordChecking as $word => $letters) {
			$size++;
			if ($size > $nb) {
				$nb = $size;
				$keyBiggerValue = $key;
			}
		}
	}
	echo($tab[$keyBiggerValue]);
}

mysupercount($tab2);

?>