<?php

$connexionBaseDeDonnees = new PDO('mysql:host=database:3306;dbname=cinema', "root", "tiger");

function queryData($connexionBaseDeDonnees, $requeteSql) {
    return $connexionBaseDeDonnees->query($requeteSql, PDO::FETCH_ASSOC)->fetchAll();
}

function showGenres($connexionBaseDeDonnees, $requeteSql) {

    $data = queryData($connexionBaseDeDonnees, $requeteSql);

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Arbre </title>
    </head>
    <body>

    <?php

    $table = "<table border=0>";

        foreach ($data as $key => $value) 
        {
            $table .=   "<tr>";

                $table .= "<td> <a href='./arbre.php?distributeur=". $value['id_distributeur'] . "'>" . $value['nom'] . "</a> </td>";

            $table .=   "</tr>";
        }

    $table .= "</table>";

    return $table;

}

function showFilmsOfGenre($connexionBaseDeDonnees, $requeteSql) {

    $data = queryData($connexionBaseDeDonnees, $requeteSql);

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Arbre </title>
    </head>
    <body>

    <style>
        th{
            border: none;
        }
    </style>

    <?php

    $genres = [];

    $table = "<table border=1>";

            foreach ($data as $key => $value) 
            {
                if (!isset($genres[$value['nom']])) {
                    $genres[$value['nom']] = [];
                    $genres[$value['nom']][] = $value['titre'];
                    $genres[$value['nom']][] = $value['date_debut_affiche'];
                    $genres[$value['nom']][] = $value['id_film'];
                } else {
                    $genres[$value['nom']][] = $value['titre'];
                    $genres[$value['nom']][] = $value['date_debut_affiche'];
                    $genres[$value['nom']][] = $value['id_film'];
                }
            }

        $table .=   "<tbody>";

        foreach ($genres as $key => $value) {

            $table .= "<th colspan = '2'>" . $key . "</th>";

            for ($info = 0; $info < count($value); $info+=3)
            {
                $table .=   "<tr>";

                    $table .= "<td>" . substr($value[$info+1], 0, 4) . "</td>";
                    
                    $table .= "<td> <a href='./arbre.php?film=" . $value[$info+2] . "'>" . $value[$info] . "</a></td>";
    
                $table .=   "</tr>";
            }
        }

        $table .=  "</tbody>";

    $table .= "</table>";

    return $table;

}

function showFilm($connexionBaseDeDonnees, $requeteSql) {

    $data = $connexionBaseDeDonnees->query($requeteSql, PDO::FETCH_ASSOC)->fetchAll();

    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $data[0]['Titre'] ?>, <?php echo $data[0]['Genre'] ?>, <?php echo $data[0]['Année de production'] ?>, <?php echo $data[0]['Distributeur'] ?>">
        <meta name="keywords" content="<?php $resumeWords = explode(' ', $data[0]['Resume']);
            $keywords = [];
            foreach ($resumeWords as $word) {
                if (strlen($word) >= 5 && strlen($word) <= 10) {
                    $keywords[] = $word;
                }
            }
            echo implode(',', $keywords);
        ?>">
        <title> <?php echo $data[0]['Titre'] ?> </title>
    </head>
    <body>

    <?php

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

    $table .= "<button><a href=" . $_SERVER['HTTP_REFERER'] . ">Retour à la page précédente</a></button>";

    return $table;

}

$url = ($_SERVER['REQUEST_URI']);

if (($pos = strpos($url, '?')) !== FALSE ) {
    $id = substr($url, $pos + 1);
}

if (isset($id) && strpos($id, 'distributeur=') !== FALSE){
    $idDistributeur = substr($id, strpos($id, 'distributeur=') + 13);
    echo showFilmsOfGenre($connexionBaseDeDonnees, "SELECT genres.nom, date_debut_affiche, titre, id_film FROM films INNER JOIN genres ON films.id_genre = genres.id_genre WHERE id_distributeur=$idDistributeur ORDER BY genres.nom, date_debut_affiche, titre ASC;");
} else if (isset($id) && strpos($id, 'film=') !== FALSE) {
    $idFilm = substr($id, strpos($id, 'film=') + 5);
    echo showFilm($connexionBaseDeDonnees, "SELECT titre AS 'Titre', resum AS 'Resume', genres.nom AS 'Genre', distributeurs.nom AS 'Distributeur', annee_production AS 'Année de production', date_debut_affiche AS 'Année de début d\'affiche' FROM films INNER JOIN genres ON films.id_genre = genres.id_genre INNER JOIN distributeurs ON films.id_distributeur = distributeurs.id_distributeur WHERE id_film = $idFilm");
} else {
    echo showGenres($connexionBaseDeDonnees, "SELECT * FROM distributeurs;"); 
}

?>

</body>
</html>