<?php

$inputs = explode(',', file_get_contents('input.txt'));

foreach ($inputs as $key => $value) {
    $inputs[$key] = intval($value);
}

// function nbOfFish($inputs, $day) {
//     for ($i = 0; $i < $day; $i++) {
//         foreach($inputs as $fishes => $fish) {
//             if ($inputs[$fishes] === 0) {
//                 $inputs[$fishes] = 6;
//                 $inputs[] = 8;
//             } else {
//                 $inputs[$fishes] -= 1;
//             }  
//         }
//     }
//     var_dump(count($inputs));
// }

// nbOfFish($inputs, 80);

// die;

function optimisedNbOfFish ($inputs, $day) {
    $daysLeftFishes = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0,];
    for ($i = 0; $i < $day; $i++) {
        $toAdd = 0;
        foreach($daysLeftFishes as $key => $value) {
            if ($key === 0) {
                $toAdd = $value;
                $daysLeftFishes[0] -= $value;
            } else {
                $daysLeftFishes[$key] -= $value;
                $daysLeftFishes[$key - 1] += $value; 
            }   
        }
        $daysLeftFishes[6] += $toAdd;
        $daysLeftFishes[8] += $toAdd;
    }
    return array_sum(array_values($daysLeftFishes));
}

echo(optimisedNbOfFish($inputs, 256));

// 43862715864130 FAUX
// 2.4599691277833E+28 FAUX
// 39506483520770 FAUX
// 

?>