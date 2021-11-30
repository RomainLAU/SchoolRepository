
<?php

$connexionBaseDeDonnees = new PDO('mysql:host=localhost;dbname=cinema', "root", "");

function queryData($connexionBaseDeDonnees, $requeteSql) {
    return $connexionBaseDeDonnees->query($requeteSql, PDO::FETCH_ASSOC)->fetchAll();
}

$films = queryData($connexionBaseDeDonnees, 'SELECT id_film, titre, resum, annee_production, id_distributeur FROM films;');

function showQueryAsTable($connexionBaseDeDonnees, $requeteSql) {

    $data = $connexionBaseDeDonnees->query($requeteSql, PDO::FETCH_ASSOC)->fetchAll();

    echo "<h1>" . $requeteSql . "</h1>";

    $table = "<table border=1>";

    $table .=   "<tr>";

    foreach ($data[0] as $colonne => $value) 
    {
        $table .=    "<th>" . $colonne . "</th>";
    }

    $table .=   "</tr>";

    foreach ($data as $key => $value) 
    {
        $table .=   "<tr>";

        foreach($value as $colonne => $value2) 
        { 
            $table .= "<td>" . $value2 . "</td>";
        }

        $table .=   "</tr>";
    }

    $table .= "</table>";

    return $table;

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

    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT *distribiteurs.nom FROM films INNER JOIN distribiteurs;") ?>

</body>
</html>