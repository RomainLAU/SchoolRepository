<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Articles</title>
    </head>
    <body>

<?php

$connexionBaseDeDonnees = new PDO('mysql:host=database:3306;dbname=article', "root", "tiger");

function queryData($connexionBaseDeDonnees, $requeteSql) {
    return $connexionBaseDeDonnees->query($requeteSql, PDO::FETCH_ASSOC)->fetchAll();
}

function showArticles ($connexionBaseDeDonnees, $requeteSql) {
    $data = queryData($connexionBaseDeDonnees, $requeteSql);

    $table = "<table border=1>";

        foreach ($data as $key => $value) 
        {
            $table .=   "<tr>";

                $table .= "<td>" . $value['titre'] . " " . $value['description'] . " " . $value['url'] . "</td>";

            $table .=   "</tr>";
        }

    $table .= "</table>";

    return $table;
}

$url = ($_SERVER['REQUEST_URI']);

if (strpos($url, '/articles') !== FALSE ) { 
    echo showArticles($connexionBaseDeDonnees, "SELECT * FROM article;");
} else { ?>

        <form action="" method="POST">
            <input type="text" name="titre" placeholder="Titre de l'article">
            <input type="text" name="description" placeholder="Description de l'article">
            <input type="text" name="url" placeholder="URL de l'image">
            <input type="submit">
        </form>

    <?php

    if (isset($_POST['titre']) && $_POST['titre'] != null && isset($_POST['description']) && $_POST['description'] != null && $_POST['url'] != null && isset($_POST['url'])) {
        $titre = addslashes($_POST['titre']);
        $description = addslashes($_POST['description']);
        $url = $_POST['url'];
        try {
            $connexionBaseDeDonnees = new PDO('mysql:host=database:3306;dbname=article', "root", "tiger");
            $connexionBaseDeDonnees->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = "INSERT INTO article (titre, description, url) VALUES ('$titre', '$description', '$url')";
            $connexionBaseDeDonnees->exec($statement);
            echo "<script> location.replace('./ajout.php/articles'); </script>";
        } catch(PDOException $e) {
            echo $statement . "<br>" . $e->getMessage();
        }

        $connexionBaseDeDonnees = null;
    }
}

?>



</body>
</html>