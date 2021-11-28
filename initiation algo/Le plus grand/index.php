<?php

$biggestNumber = [1, 5, 6, 2, 9, 10, 15, 8, 26, 5, 18, 9];




function whichIsBigger ($list)  {
    $bigger = 0;
    foreach ($list as $numbers => $number) {
        if ($number > $bigger) {
            $bigger = $number;
        }
    }
    return $bigger;
}

var_dump(whichIsBigger($biggestNumber));


?>