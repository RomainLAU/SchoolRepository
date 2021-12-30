<?php

$inputs = file('input.txt');

$count = 0;

for ($i = 1; $i < count($inputs); $i++) {
    if ($inputs[$i] > $inputs[$i-1]) {
        $count++;
    }  
}
echo $count;
?>