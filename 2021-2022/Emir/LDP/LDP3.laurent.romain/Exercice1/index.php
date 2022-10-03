<?php

foreach($_POST as $key => $value) {
	if($key != submit && strlen($value)<=10) {
		echo($key . "=>" . $value . "<br>");
	} else if ($key != submit && strlen($value)>10) {
		$reducted = substr($value, 0, 7);
		echo("$key => $reducted... <br>");
	}
}

?>