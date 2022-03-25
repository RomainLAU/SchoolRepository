<?php

if (!isset($_POST[youtubeurs]) || $_POST[youtubeurs] == 'empty') {
	echo("Vous n'avez séléctionné aucun youtubeur.");
} else {
	echo($_POST[youtubeurs]);
}

?>