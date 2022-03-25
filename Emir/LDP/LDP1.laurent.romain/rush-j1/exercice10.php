<?php

function isAdult($year) {
    if (2021 - $year >= 18) {
        echo('True');
        return true;
    } else {
        echo('False');
        return false;
    }
}

isAdult(2000);

?>