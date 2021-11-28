<?php

function letterCode ($chars) {
    $charsList = str_split($chars);
    $number = 0;
    foreach ($charsList as $letters => $letter) {
        if ($letter == 'a') {
            $number += 10;
        } else if ($letter == 'r') {
            $number -= 3;
        } else if ($letter == 'd') {
            $number = ceil($number/2);
        } else if ($letter == 'm') {
            $number *= 3;
        }
    }
    return $number;
}

var_dump(letterCode('aarmdd'));

?>