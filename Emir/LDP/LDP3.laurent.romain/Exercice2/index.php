<?php

if (!isset($_POST[tortue])) {
	echo("<p style='color:red;''> Vous n'avez séléctionné aucune tortue. </p>");
} else {
	echo("<p style='color:green;''> $_POST[tortue] </p>");
}

?>