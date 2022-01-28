<?php
session_start();

if (isset($_SESSION['connected']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && $_SESSION['connected']) {
    echo ("
    <ul>
        <div>Bienvenue ". $_SESSION['firstname'] . " " . $_SESSION['lastname'] . " !</div>
        <li><a href='deconnection.php'>Se déconnecter</a></li>
        <li><a href='index.php'>Ajouter un nouveau film</a></li>
        <li><a href='movies.php'>Voir tous les films</a></li>
    </ul>
    ");
} else {
    echo ("
    <ul>
        <li><a href='register.php'>S'enregistrer</a></li>
        <li><a href='connection.php'>Se connecter</a></li>
        <li><a href='movies.php'>Voir tous les films</a></li>
    </ul>");
}

?>