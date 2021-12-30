<?php

try{
    $connexionBaseDeDonnees = new PDO('mysql:host=localhost;dbname=cinema', "root", "");
    $films = $connexionBaseDeDonnees->query('SELECT * from films', PDO::FETCH_ASSOC)->fetchAll();

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

<table border="1"
    ><tr>
<?php
    foreach($films[0] as $key => $film) { ?>
         <th><?php
            echo $key;
        ?> </th> <?php
    } ?> </tr> <?php
    foreach($films as $key => $film) { ?>
        <tr> <?php
        foreach($film as $detail) { ?>
            <td>
                <p> <?php echo $detail ; ?></p>
            </td>
            <?php
        }
        ?>
        </tr>
        
    <?php }
?>
</table>
</body>
</html>