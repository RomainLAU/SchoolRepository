<?php

$buttonList = [
    'czptih', 'oyniwx', 'uuknuv', 'czptih', 'lbyfrh', 'jfqvky',
    'zfikll', 'jfqvky', 'ivxgel', 'bhlunk', 'fttdoq', 'ddsnyy',
    'bhlunk', 'eyhrsq', 'ddsnyy', 'czptih', 'czptih', 'ddsnyy', 'bqfpvi',
    'jfqvky', 'jtornb', 'lbyfrh', 'bhlunk', 'uuknuv', 'jrzhfd', 'czptih',
    'uuknuv', 'czptih', 'ivxgel', 'etbwyp', 'ubwfdu', 'uuknuv', 'lbyfrh',
    'etbwyp', 'lbyfrh', 'ddsnyy', 'ddsnyy', 'bhlunk', 'czptih', 'kyskbf',
    'qcjojj', 'uuknuv', 'ivxgel', 'credvm', 'lbyfrh', 'eyhrsq', 'laxutf',
    'etbwyp', 'lkgcgo', 'etbwyp', 'jfqvky', 'uuknuv', 'lbyfrh', 'hpxtot',
    'ddsnyy', 'bhlunk', 'iafvaz', 'qdmxzc', 'ivxgel', 'dudgrg', 'oyniwx',
    'bhlunk', 'ohjyio', 'njbzhp', 'vfrfjx', 'uuknuv', 'eyhrsq', 'djlqqx',
    'oyniwx', 'kyskbf', 'ivxgel', 'laxutf', 'vfrfjx', 'eyhrsq', 'uuknuv',
    'sumqei', 'qcjojj', 'vfrfjx', 'dbioge', 'heaves', 'zkmjoy', 'ivxgel',
    'kyskbf', 'eyhrsq', 'bhlunk', 'czptih', 'jfqvky', 'etbwyp', 'jfqvky',
    'ngzhgt', 'laxutf', 'qcjojj', 'ivxgel', 'eyhrsq', 'etbwyp', 'ivxgel',
    'rpcaue', 'lbyfrh', 'jtornb'
];

function goodButton ($buttonList) {
    $isItTheGoodOne = [];
    foreach ($buttonList as $buttons => $button) {
        foreach ($buttonList as $buttonsToComparate => $buttonToComparate) {
            if ($buttons != $buttonsToComparate && $button == $buttonToComparate) {
                if (count($isItTheGoodOne) == 0) {
                    array_push($isItTheGoodOne, $buttonToComparate);
                } else {
                    $isItTheGoodOne = [];
                    continue;
                }
            }
        }
    }
    return $isItTheGoodOne[0];
}


// fonction qui crée un array multidimensionnel associatif pour chaque mot différent de la liste, pas encore "testé", et lorsqu'on trouve une nouvelle occurence du mot entrain d'être analysé, on ajoute un élément dans l'array, exemple : 
    // [
    //     'czptih' => [
    //         1 ( dans le cas où il y aurait 4 fois le mot dans la liste (donc 3 éléments dans l'array car le premier élément permet de créer l'array))
    //     ]
    // ]
// Mais si l'array contient déjà un élément, cela veut dire qu'il y a plus de 2 fois le mot dans la liste, donc on efface le contenu de l'array et on passe au mot d'après


var_dump(goodButton($buttonList));

?>