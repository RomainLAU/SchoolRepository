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
    Texte traduit &nbsp; : &nbsp;

<?php

$form = $_POST['cyrillic'];
$form = mb_strtolower($form);

$cyrillicAlphabet = [
    'а' => 'a',
    'б' => 'b',
    'в' => 'v',
    'г' => 'g',
    'д' => 'd',
    'е' => 'ié',
    'ё' => 'io',
    'ж' => 'j',
    'з' => 'z',
    'и' => 'i',
    'й' => 'ï',
    'к' => 'k',
    'л' => 'l',
    'м' => 'm',
    'н' => 'n',
    'о' => 'o',
    'п' => 'p',
    'р' => 'r',
    'с' => 's',
    'т' => 't',
    'у' => 'ou',
    'ф' => 'f',
    'х' => 'kh',
    'ц' => 'ts',
    'ч' => 'tch',
    'ш' => 'ch',
    'щ' => 'chtch',
    'э' => 'è',
    'ю' => 'iou',
    'я' => 'ia',
    ' ' => ' '
];

$toDecode = explode(',', $form);

$translatedSentence = [];

foreach ($toDecode as $cyrillic) {
    foreach ($cyrillicAlphabet as $cyrillicLetters => $cyrillicLetter) {
        if ($cyrillic == $cyrillicLetters) {
            echo($cyrillicLetter);
        }
    }
}

?>

<br><br><br><br><br><br>
    <a href="index.html">Traduire un autre texte</a>
</body>
</html>