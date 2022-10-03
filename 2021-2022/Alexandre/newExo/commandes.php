<?php

$goodValue = 37;

echo "Enter your number: \n";

$answer = intval(fgets(STDIN));

if ($answer > $goodValue) {
    echo "Your number is too high ";
} else if ($answer < $goodValue) {
    echo "Your number is too low ";
}


// if ($quizFinished === false) {
//     if ($answer < $goodValue) {
//         echo "La valeur est plus grande...";
//     } else if ($answer > $goodValue) {
//         echo "La valeur est plus petite...";
//     } else if ($answer === $goodValue) {
//         $quizFinished === true;
//         return "gg";
//     }

//     echo "Enter your number: <br>";

//     $answer = fgets(STDIN);
// }

while ($answer !== $goodValue) {
    $answer = intval(fgets(STDIN));

    if ($answer > $goodValue) {
        echo "Your number is too high ";
    } else if ($answer < $goodValue) {
        echo "Your number is too low ";
    }
}

echo 'Well played !';

// if ($answer === $goodValue) {
//     echo "Bravo ! C'est la bonne réponse !";
// }

?>