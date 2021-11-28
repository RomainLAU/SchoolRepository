<?php

function sommeEntier ($start) {
    $result = [];
    for ($i = 1; $i <= $start; $i++) {
        array_push($result, $i);
    }
    return array_sum($result);
}

var_dump(sommeEntier(5));

?>