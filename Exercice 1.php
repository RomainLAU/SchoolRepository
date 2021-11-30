<?php

try{
    $connexionBaseDeDonnees = new PDO('mysql:host=localhost;dbname=cinema', "root", "");
    $films = $connexionBaseDeDonnees->query('SELECT titre, resum, date_debut_affiche from films ORDER BY titre ASC', PDO::FETCH_ASSOC);

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



<table border="1">

    <th><?php
    foreach($films as $key => $film) {
        $col = $films->getColumnMeta($key);
        $columns[]=$col['name'];?>
        <td><?php echo $columns[$key]; ?> </td>
        
    <?php } ?>
    </th><?php
    foreach($films as $key => $film) {?>
        <tr>
        <?php
            foreach($film as $array => $detail) { ?>
                <td><?php
                    echo("$detail");
                ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>

</body>
</html>