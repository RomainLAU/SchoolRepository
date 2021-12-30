<?php

$dsn = 'mysql:host=database:3306;dbname=article';

try{
    $PDO = new PDO($dsn, "root", "tiger");
    $articles = $PDO->query("SELECT * FROM article", PDO::FETCH_ASSOC)->fetchAll();
} catch (PDOException $exception) {
    print "Erreur !: " . $exception->getMessage() . "<br>";
    die;
}


echo "<table border=1>";
foreach($articles as $article) {
    echo "<tr>";
    foreach($article as $key => $value) {
        if ($key !== 'id') {
            echo "<td> $value </td>";
        }
    }
    echo "<td>
            <form method='POST' action='delete.php'>
            <input name='id' value='" . $article['id'] . "' hidden>
            <input type='submit' value='Delete'>
            </form>
        </td>";
    echo "<td>
        <form method='GET' action='update.php'>
        <input name='id' value='" . $article['id'] . "' hidden>
        <input type='submit' value='Update'>
        </form>
    </td>";
    echo "</tr>";
}
echo "</table>";
?>