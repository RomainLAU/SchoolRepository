<?php

$inputs = explode("\n",file_get_contents('input.txt'));

$map = [];

foreach ($inputs as $line) {
    $strArray = str_split($line);
    $numberArray = [];
    foreach ($strArray as $num) {
        $numberArray[] = intval($num);
    }
    $map[] = $numberArray;
}


function deepestValues ($map) {
    $directions = [
        ['y' => 0, 'x' => -1],
        ['y' => -1, 'x' => 0],
        ['y' => 0, 'x' => 1],
        ['y' => 1, 'x' => 0],
    ];
    
    $deepestPoints = []; // Array qui contiendra toutes les valeurs considérées comme les plus petites

    for ($y = 0; $y < count($map); $y++) { // Pour chaque ligne de valeurs ( array de valeurs )
        
        for ($x = 0; $x < count($map[$y]); $x++) { // On boucle sur chaque valeur de la ligne ( l'array )
            $possibleDirections = [];
            $isDeeper = False; // Variable booléenne qui permet de décider si on doit ajouter la valeur actuelle à l'array $deepestPoints
            // Ces 4 if permettent de vérifier si les valeurs adjacentes existent, si c'est le cas, on les ajoute à l'array $possibleDirections
            if (isset($map[$y+$directions[0]['y']][$x+$directions[0]['x']])) {
                $direction1 = [isset($map[$y+$directions[0]['y']][$x+$directions[0]['x']])];
            }
            if (isset($map[$y+$directions[1]['y']][$x+$directions[1]['x']])) {
                $direction2 = [isset($map[$y+$directions[1]['y']][$x+$directions[1]['x']])];
            }
            if (isset($map[$y+$directions[2]['y']][$x+$directions[2]['x']])) {
                $direction3 = [isset($map[$y+$directions[2]['y']][$x+$directions[2]['x']])];
            }
            if (isset($map[$y+$directions[3]['y']][$x+$directions[3]['x']])) {
                $direction4 = [isset($map[$y+$directions[3]['y']][$x+$directions[3]['x']])];
            }

            foreach ($possibleDirections as $possibleDirection) { // On boucle sur l'array des valeurs adjacentes existentes
                if ($map[$y][$x] < $possibleDirection) { // On compare la valeur à ses valeurs adjacentes
                    $isDeeper = True; // Lorsque la valeur est inférieur on change la variable $isDeeper à True pour valider le fait que c'est la plus petite valeur
                } else {
                     return False; // Si une valeur adjacente est plus petite que la valeur actuelle alors on return False pour passer à la valeur suivante
                }
            }
            if ($isDeeper === True) { // Si après la boucle, la variable $isDeeper est définie à True
                $deepestPoints = [$map[$y][$x]]; // On rajoute la valeur à l'array $deepestPoints
            }
        }
    }
    return array_sum($deepestPoints); // Lorsque l'on a ajouté toutes les plus petites valeurs à l'array $deepestPoints, on renvoie la somme de ces valeurs
}

echo(deepestValues($map));

?>