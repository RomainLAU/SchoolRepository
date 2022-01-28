<?php

$inputs = file('input.txt');

$countingArray = [];
$lastSum = 0;
$iteration = 0;

foreach($inputs as $key => $value) {
    if (count($countingArray) === 3 ) {
        if (array_sum($countingArray) > $lastSum) {
            $lastSum = array_sum($countingArray);
            var_dump($countingArray, $lastSum);
            $iteration++;
        }
        array_shift($countingArray);
    }
    else {
        $countingArray[] = $value;
    }
}

echo($iteration);

?>