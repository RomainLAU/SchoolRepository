<?php

$dsn = 'mysql:host=database:3306;dbname=article';

$updateForm = $_GET;

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $articles = $PDO->query("SELECT * FROM article WHERE id = " . $updateForm['id'], PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}


if (isset($_POST['update'])) {
    $statement = $PDO->prepare("UPDATE article SET titre = :titre, description = :description, url = :url WHERE id = :id");

    $statement->execute([
        'id' => $updateForm['id'],
        'titre' => $_POST['titre'],
        'description' => $_POST['description'],
        'url' => $_POST['url'],
    ]);

    header('location:articles.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        <input type="text" value=" <?php echo $articles[0]['titre']; ?>" name="titre">
        <input type="text" value=" <?php echo $articles[0]['description']; ?>" name="description">
        <input type="text" value=" <?php echo $articles[0]['url']; ?>" name="url">
        <input type="submit" value="Update" name="update">
    </form>
</body>
</html>

