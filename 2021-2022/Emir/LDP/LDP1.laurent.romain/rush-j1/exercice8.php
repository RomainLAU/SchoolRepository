<?php

function isOdd($data) {
    if ($data%2 == 1) {
        return true;
    } else {
        return false;
    }
}

var_dump(isOdd(13));

?>