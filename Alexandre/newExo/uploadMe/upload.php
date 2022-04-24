<?php

$file = $_FILES['uploadedFile'];
$fileTitle = $_POST['title'];

move_uploaded_file($file['tmp_name'], __DIR__ . "/files/" . $file['name']);

$PDO = new PDO('mysql:host=database:3306;dbname=imageDB', "root", "tiger");

if (isset($file) && isset($fileTitle)) {
    $statement = $PDO->prepare('INSERT INTO `images` (`title`, `image_name`) VALUES (:title, :image_name)');

    $statement->execute([
        'title' => $fileTitle,
        'image_name' => $file['name'],
    ]);
}

header('location: /');
exit();

?>