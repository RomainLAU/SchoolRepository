<?php
session_start();
include('dishes.php');


if(isset($_POST['cancel'])) {
    unset($_SESSION['allOrders'][$_POST['order']]);
    $_SESSION['allOrders'] = array_values($_SESSION['allOrders']);
    header('Location: commandes.php');
} else if (isset($_POST['validate'])) {
    array_push($_SESSION['CA'], $_SESSION['allOrders'][$_POST['order']]['price']*$_SESSION['allOrders'][$_POST['order']]['quantity']);
    unset($_SESSION['allOrders'][$_POST['order']]);
    $_SESSION['allOrders'] = array_values($_SESSION['allOrders']);
    header('Location: commandes.php');
}


?>