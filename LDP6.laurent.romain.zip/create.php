<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un film</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="genre" placeholder="id du genre">
        <input type="text" name="distributeur" placeholder="id du distributeur">
        <input type="text" name="titre" placeholder="titre du film">
        <input type="text" name="resum" placeholder="résumé">
        <input type="text" name="date_debut_affiche" placeholder="date de début d'affiche">
        <input type="text" name="date_fin_affiche" placeholder="date de fin d'affiche">
        <input type="text" name="duree" placeholder="durée en minutes">
        <input type="text" name="annee_production" placeholder="année de production">
        <input type="submit">
    </form>
</body>
</html>

<?php

if (isset($_POST['genre']) && isset($_POST['distributeur']) && isset($_POST['titre']) && isset($_POST['resum']) && isset($_POST['date_debut_affiche']) && isset($_POST['date_fin_affiche']) && isset($_POST['duree']) && isset($_POST['annee_production'])) {
    $genre = $_POST['genre'];
    $distributeur = $_POST['distributeur'];
    $titre = addslashes($_POST['titre']);
    $resum = addslashes($_POST['resum']);
    $dateDebutAffiche = $_POST['date_debut_affiche'];
    $dateFinAffiche = $_POST['date_fin_affiche'];
    $duree = $_POST['duree'];
    $anneeProduction = $_POST['annee_production'];
}

try {
    $connexionBaseDeDonnees = new PDO('mysql:host=database:3306;dbname=cinema', "root", "tiger");
    $connexionBaseDeDonnees->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = "INSERT INTO films (id_genre, id_distributeur, titre, resum, date_debut_affiche, date_fin_affiche, duree_minutes, annee_production) VALUES ($genre, $distributeur, '$titre', '$resum', '$dateDebutAffiche', '$dateFinAffiche', $duree, '$anneeProduction')";
    $connexionBaseDeDonnees->exec($statement);
    echo "New record created successfully";
} catch(PDOException $e) {
  echo $statement . "<br>" . $e->getMessage();
}

$connexionBaseDeDonnees = null;

?>