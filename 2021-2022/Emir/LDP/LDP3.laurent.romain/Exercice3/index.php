<?php

if (!isset($_POST[poney])) {
	echo("Vous n'avez séléctionné aucun ponney.");
} else {
	foreach ($_POST['poney'] as $poney) {
        $poneys[] = $poney;
    }    $selectedPoneys = implode(', ', $poneys);
        echo($selectedPoneys);
}

?>