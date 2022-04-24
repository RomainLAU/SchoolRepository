<?php

// var_dump(__DIR__);

move_uploaded_file($_FILES['uploadedFile']['tmp_name'], __DIR__ . "/" . $_FILES['uploadedFile']['name']);

echo "<img src='" . $_FILES['uploadedFile']['name'] . "' width=400 height=200>"

?>