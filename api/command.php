<?php 


require_once 'cart.php';

function command() {
    $total = 0;
    $cart = getCart();
    foreach ($cart as $article):
        $total += $article['Price']*$_SESSION["cart"][$article["Id"]]["quantity"];
    endforeach;
    $user = getUserById($_SESSION["user"]);
    if ($total > $user["Balance"]) {
        echo "Solde insuffisant";
        return;
    } else {
        echo "c'est good";
    }
}


function addMoney(int $amount) {
    $user = getUserById($_SESSION["user"]);
    $newValue = (float) $user["Balance"] + (float) $amount;
    if ($amount <= 0) {
        echo "Montant invalide";
        return;
    }
    echo"$newValue";
    updateUserBalance($_SESSION["user"], $newValue);
    var_dump($_SESSION["user"]);
}


command();





?>