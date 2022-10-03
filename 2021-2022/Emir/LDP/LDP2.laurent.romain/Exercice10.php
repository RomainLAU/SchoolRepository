<?php

$tab0 = ['Goodbye', 'Dennis'];

$tab1 = ['U', 'DUN', 'GOOFED'];

$tab2 = ['name'=>'Glenn','first_name'=>'kenny','pets'=>'dusty','crime'=>'animal abuse','achievement'=>'goofed'];

$tab3 = ['bananas', 'apple','fish'=>'sharktopus', 'lemon', 'pineapple', 'pear', 'cherry'];

$tab4 = ['x-men', 'spiderman','great saiyaman','iron man','superman', 'batman','wolverine', 'hulk'];

function mysupercount($tab) {
    $onlyInt = True;
    $keyB = 0;
    foreach ($tab as $key => $keyValue) {
        $keyB = $key;
        if (gettype($key) == "string") {
            $onlyInt = False;
            break;
        }
    }
    if ($onlyInt) {
        echo($keyB);
    } else {
        $nbOfChar = 0;
	    $keyBiggerValue = 0;
        foreach($tab as $key => $value) {
            $size = 0;
            if (gettype($key) == "string") {
                $wordChecking = str_split($key);
                foreach($wordChecking as $word => $letters) {
                    $size++;
                    if ($size > $nbOfChar) {
                        $nbOfChar = $size;
                        $keyBiggerValue = $key;
                    }
                }
            }
        }
        echo($keyBiggerValue);
    }
}

mysupercount($tab2);

?>