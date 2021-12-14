<?php

function sommeEntier ($start) {
    $result = 0;
    for ($i = 1; $i <= $start; $i++) {
        $result += $i;
    }
    return $result;
}

echo(sommeEntier(5));

?>