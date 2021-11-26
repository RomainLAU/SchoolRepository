<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include('baseMenu.php');
?>
<?php
include('dishes.php');

$form = $_POST;

if (isset($_SESSION['allOrders'])) {
    $previousOrder = $_SESSION['allOrders'];
} else {
    $_SESSION['allOrders'] = [];
    $previousOrder = $_SESSION['allOrders'];
}

if (isset($form['dish']) && $form['dish'] != "" && $form['quantity'] > 0) {
    $tabOrder = [
        "food" => $dishes[$form['dish']]['name'], 
        "quantity" => $form['quantity'],
        "price" => $dishes[$form['dish']]['price']
    ];
    $push = array_push($previousOrder, $tabOrder);
}

$_SESSION['allOrders'] = $previousOrder;

// Différentes choses à afficher selon ce qui a été séléctionné dans la page

if ($form['quantity'] == 1 && $form['dish'] != null) {
    echo("<p>Nous avons bien pris en compte votre commande ! <br><br></p>");
    echo('<p>Récapitulatif : ' . $form['quantity'] . ' ' . $dishes[$form['dish']]['name']);
    echo("<br> Le tout pour " . $dishes[$form['dish']]['price'] * $form['quantity'] . "€</p>");
} else if ($form['quantity'] >= 2 && $form['quantity'] <= 12  && $form['dish'] != null) {
    echo("<p>Nous avons bien pris en compte votre commande ! <br><br></p>");
    echo('<p>Récapitulatif : ' . $form['quantity'] . 'x ' . $dishes[$form['dish']]['name'] . 's');
    echo("<br> Le tout pour " . $dishes[$form['dish']]['price'] * $form['quantity'] . "€</p>");
} else if ($form['quantity'] == null && $form['dish'] == null) {
    echo("<p>Vous n'avez rien sélectionné...</p>");
} else if ($form['quantity'] == null && isset($form['dish'])) {
    echo("<p>Vous n'avez pas choisi la quantité...</p>");
} else if ($form['quantity'] != null && $form['dish'] == null) {
    echo("<p>Vous n'avez pas sélectionné de plat...</p>");
}

?>
    <br><br>
    <a href="index.php"> <button>Passer une nouvelle commande</button> </a> 

</body>
<?php

include('footer.php');

?>
</html>