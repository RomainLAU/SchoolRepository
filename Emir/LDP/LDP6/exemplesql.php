
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

    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT * FROM films;") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT id_film, titre, resum FROM films;") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT titre, resum, date_debut_affiche FROM films ORDER BY titre") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT id_film, titre, resum FROM films LIMIT 10;") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT titre, resum FROM films f INNER JOIN genres g ON f.id_genre = g.id_genre WHERE g.nom LIKE 'adventure';") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT titre AS titre_film, resum AS resum_film FROM films WHERE titre LIKE '%28%';") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT titre, resum FROM films WHERE id_film IN (4,8,15,16,23,42);") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT sum(places) AS 'places' FROM salles;") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT date_debut_affiche, CONCAT('nouveauté ', titre) AS 'titre film' FROM films WHERE date_debut_affiche >= '2011-11-16' ORDER BY id_film desc;") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT * FROM films WHERE date_debut_affiche < '1995-03-25' ORDER BY date_debut_affiche LIMIT 10,10;") ?>
    <?php echo showQueryAsTable($connexionBaseDeDonnees, "SELECT etage_salle AS 'num etage', places AS 'nbr place' FROM salles WHERE places > 100 AND (etage_salle BETWEEN 1 AND 3) ORDER BY etage_salle desc;") ?>

</body>
</html>