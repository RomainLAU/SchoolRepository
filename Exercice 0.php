<?php

try{
    $connexionBaseDeDonnees = new PDO('mysql:host=localhost;dbname=cinema', "root", "");
    $films = $connexionBaseDeDonnees->query('SELECT * from films', PDO::FETCH_ASSOC);

} catch (PDOException $e) {

    print "Erreur !: " . $e->getMessage() . "<br/>";

    die();
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
<?php
    foreach($films as $key => $film) { ?>

        <p> <?php echo $film['id_film']; ?>,
            <?php echo $film['titre']; ?> </p>
        <p> <?php echo $film['resum']; ?> </p>

    <?php }
?>
</body>
</html>