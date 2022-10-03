<?php
session_start();
?>

<?php

if (isset($_SESSION['connected']) && $_SESSION['connected'] == 'yes') {
    echo("
    <ul>
        <li><a href='index.php'>Accueil</a></li>
        <li><a href='commandes.php'>Commandes</a></li>
        <li><a href='delete.php'>Déconnexion</a></li>
    </ul>
    ");
} else {
    echo("
    <ul>
        <a href='index.php'><li>Accueil</li></a>
        <a href='connect.php'><li>Se connecter</li></a>
    </ul>
    ");
}
?>