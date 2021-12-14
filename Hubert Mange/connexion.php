<?php
session_start();

$form = $_POST;

if ($form['password'] == 'mange' && $form['id'] == 'hubert' && $form['password'] != null && $form['id'] != null) {
    $_SESSION['connected'] = 'yes';
    header('Location: index.php');
} else if ($form['password'] == null && $form['id'] != null) {
    $_SESSION['connected'] = 'no';
    header('Location: connect.php');
} else if ($form['id'] == null && $form['password'] != null) {
    $_SESSION['connected'] = 'no';
    header('Location: connect.php');
} else if ($form['id'] == null && $form['password']) {
    $_SESSION['connected'] = 'no';
    header('Location: connect.php');
} else if ($form['password'] != 'mange' && $form['id'] != 'hubert') {
    $_SESSION['connected'] = 'no';
    header('Location: connect.php');
}

?>