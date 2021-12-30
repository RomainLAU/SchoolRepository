
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubert Mange</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include('baseMenu.php');

?>
<?php


include('dishes.php');
if (!isset($_SESSION['CA'])) {
    $_SESSION['CA'] = [];
}

if (isset($_SESSION['allOrders']) &&  !empty($_SESSION['allOrders'])) {

?>

<style>
    table{
        border-collapse: collapse;
        text-align: center;
    }
    td{
        width: 200px;
    }
</style>

<table border="1">
    <tr>
        <td></td>
        <td><b>Plat</b></td>
        <td><b>Quantité</b></td>
        <td><b>Prix de la commande</b></td>
        <td><b>Actions</b></td>
    </tr>
<?php
    foreach($_SESSION['allOrders'] as $orderId => $order) {
        $id = $orderId+1;
        ?>
        <tr>
            <td> <?php
            echo("<b>Commande n° $id</b> <br>");
            ?>
            </td> <?php
            foreach($order as $array => $detail) { ?>
                <td><?php
                    if ($array == "price") {
                        echo($detail * $order['quantity'] . "€");
                    } else {
                        echo("$detail <br>");
                    }
                ?></td>
            <?php } ?> 
            <td>
                <form action="unset.php" method="POST" id="commandForm">
                    <button name="cancel" value="cancel" style="color:red;">Annuler</button>
                    <input type="hidden" name="order" value="<?php echo($orderId) ?>">
                    <button name="validate" value="validate" style="color:green;">Valider</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
    
<?php
} else {?>
    <p> Il n'y a pas encore de commande...</p> <?php
    }
    
echo("<p>Vous avez gagné : " . array_sum($_SESSION['CA']) . "€ !</p>")
?>



</body>
<?php

include('footer.php');

?>
</html>