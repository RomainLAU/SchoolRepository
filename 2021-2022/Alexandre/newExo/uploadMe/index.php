<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Upload Me</h1>
    <form action="upload" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="A beautiful image">
        <input type="file" name="uploadedFile">
        <input type="submit" value="Upload">
    </form>
    <br>
</body>
</html>

<?php

try{
    $PDO = new PDO('mysql:host=database:3306;dbname=imageDB', "root", "tiger");
    $files = $PDO->query('SELECT * FROM images', PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}

foreach($files as $file) {
    echo "<a href='picture/" . $file['id'] . "'><img src='files/" . $file['image_name'] . "'></a><br>";
};

?>