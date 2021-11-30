<?php

$biggestNumber = [1, 5, 6, 2, 9, 10, 15, 8, 5, 18, 9];

function whichIsBigger ($biggestNumber)  {
    $bigger = $biggestNumber[0];
    foreach ($biggestNumber as $numbers => $number) {
        if ($number > $bigger) {
            $bigger = $number;
        }
    }
    return $bigger;
}

var_dump(whichIsBigger($biggestNumber));


?>