<?php

$password = "jaimelespatates";

echo $password . "<br>";

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo $hashedPassword;

if (password_verify("jaimelespatates", $hashedPassword)) {
    echo "<br> CEST PAREIl";
} else {
    echo "<br> CEST PAS PAREIL";
}