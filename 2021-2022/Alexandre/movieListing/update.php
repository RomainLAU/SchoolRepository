<?php
ob_start();
include('menu.php');

$dsn = 'mysql:host=database:3306;dbname=movies';

$updateForm = $_GET;
$editIsFull = True;

foreach ($_POST as $values => $value) {
    if ($values !== 'synopsis') {
        $chars = str_split($value);
    }
    if (empty($value) || $value === '') {
        $editIsFull = False;
    }
    foreach ($chars as $char) {
        if ($char === ' ') {
            $editIsFull = False;
        }
    }
}

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $movies = $PDO->query("SELECT * FROM movie WHERE id = " . $updateForm['id'], PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}


if (isset($_POST['update']) && $editIsFull === True) {
    $statement = $PDO->prepare("UPDATE movie SET title = :title, synopsis = :synopsis, image = :image, trailer_link = :trailer_link WHERE id = :id");

    $statement->execute([
        'id' => $updateForm['id'],
        'title' => $_POST['title'],
        'synopsis' => $_POST['synopsis'],
        'image' => $_POST['image'],
        'trailer_link' => $_POST['trailer_link']
    ]);

    header('location:movies.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edition du film</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="">
        <input type="text" value="<?php echo $movies[0]['title'];?>" name="title">
        <input type="text" value="<?php echo $movies[0]['synopsis'];?>" name="synopsis">
        <input type="text" value="<?php echo $movies[0]['image'];?>" name="image">
        <input type="text" value="<?php echo $movies[0]['trailer_link'];?>" name="trailer_link">
        <input type="submit" value="Editer" name="update">
    </form>
</body>
</html>

<?php

include('footer.php');

?>