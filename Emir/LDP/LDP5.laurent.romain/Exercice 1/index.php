<?php 

function isFriday19 () {
	for ($i = 0; $i < 8; $i++) {
		$timestamp = strtotime('now +' . $i . 'day');
		if (date('l j', $timestamp) == 'Friday 28') {
			return True;
		}
	}
}

var_dump(isFriday19());

?>