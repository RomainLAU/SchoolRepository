<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>List of Books</h1>
    <ul><?php foreach($listBooks as $book): ?>
        <li>
            <?php echo "titre : " . $book['title'] . "<br> auteur : " . $book['author'] ?>
        </li>
        <?php endforeach ?>
    </ul>
</body>
</html>