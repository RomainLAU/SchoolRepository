<?php

$passwords = file('mots-de-passe-compromis.txt');

$rule = substr($passwords[37], 0, 7 );
echo $passwords[370] . "<br>" . $rule;

?>