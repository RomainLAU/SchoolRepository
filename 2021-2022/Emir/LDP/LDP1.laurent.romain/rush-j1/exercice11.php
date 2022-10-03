<?php

function isSmaller($number1, $number2, $number3) {
    if (min($number1, $number2, $number3) == $number1 ) {
        echo $number1;
    } else if (min($number1, $number2, $number3) == $number2) {
        echo $number2;
    } else if (min($number1, $number2, $number3) == $number3) {
        echo $number3;
    }
}

isSmaller(1234,541, 134356);

?>