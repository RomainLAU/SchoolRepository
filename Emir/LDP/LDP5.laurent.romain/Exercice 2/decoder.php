<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http_equiv="X_UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device_width, initial_scale=1.0">
    <title>Morse Decoder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    Texte décodé &nbsp; : &nbsp;

<?php

$form = $_POST['morse'];

$alphabetMorse = [
    '._' => 'a',
    '_...' => 'b',
    '_._.' => 'c',
    '_..' => 'd',
    '.' => 'e',
    '.._.' => 'f',
    '__.' => 'g',
    '....' => 'h',
    '..' => 'i',
    '.___' => 'j',
    '_._' => 'k',
    '._..' => 'l',
    '__' => 'm',
    '_.' => 'n',
    '___' => 'o',
    '.__.' => 'p',
    '__._' => 'q',
    '._.' => 'r',
    '...' => 's',
    '_' => 't',
    '.._' => 'u',
    '..._' => 'v',
    '.__' => 'w',
    '_.._' => 'x',
    '_.__' => 'y',
    '__..' => 'z',
    ' ' => ' '
];

$toDecode = explode(',', $form);

$decodedSentence = [];

foreach ($toDecode as $morse) {
    foreach ($alphabetMorse as $coded => $letter) {
        if ($morse == $coded) {
            echo($letter);
        }
    }
}

?>

    <br><br><br><br><br><br>
    <a href="index.html">Décoder un autre texte</a>
</body>
</html>