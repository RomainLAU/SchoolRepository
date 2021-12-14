<?php
session_start();

if (isset($_SESSION['connected']) && $_SESSION['connected']) {
    echo "<a href='deconnection.php'>Se déconnecter</a>";
} else {
    echo "<a href='register.php'>S'enregistrer</a> &nbsp;
    <a href='connection.php'>Se connecter</a>";
}

?>