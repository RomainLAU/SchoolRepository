<?php

function getComment($note, $triche, $rendu) {
    if ($rendu == true) {
        echo ("Votre n'avez pas rendu de devoir<br>");
    } else if ($note == 0) {
        echo ("Aucun effort<br>");
    } else if ($note == 5) {
        echo ("A essayé<br>");
    } else if ($note == 7) {
        echo ("C'est mieux que 5<br>");
    } else if ($note == 10) {
        echo ("Pile poil la moyenne<br>");
    } else if ($note == 12) {
        echo ("Assez bien<br>");
    } else if ($note == 14) {
        echo ("Bien<br>");
    } else if ($note == 16 && $triche == false) {
        echo ("Très bien<br>");
    } else if ($note == 16 && $triche == true) {
        echo ("Triche<br>");
    } else if ($note == 20 && $triche == false) {
        echo ("Excellent<br>");
    } else if ($note == 20 && $triche == true) {
        echo ("Triche excellente<br>");
    }
}


// J'affiche tous les résultats possibles
getComment(0 , false, true);
getComment(0 , false, false);
getComment(5 , false, false);
getComment(7 , false, false);
getComment(10 , false, false);
getComment(12 , false, false);
getComment(14 , false, false);
getComment(16 , false, false);
getComment(16 , true, false);
getComment(20 , false, false);
getComment(20 , true, false);

?>