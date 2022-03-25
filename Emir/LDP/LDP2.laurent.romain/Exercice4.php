<?php

function isOdd($data) {
    if ($data%2 == 1) {
        return true;
    } else {
        return false;
    }
}

for ($i = 0; $i<=20; $i++) {
    if (isOdd($i)) {
        echo($i . "<br>");
    }
}

?>