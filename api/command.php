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
        createCommand($total);
        removeMoney($total);
    }
}

function createCommand($total) {
    $cart = getCart();
    $array = createDetailsCommand($cart);
    $userId = $_SESSION["user"];
    var_dump($array);
    $commandid = createOrder($userId,$total, $array);
}

function createDetailsCommand($articles): array {
    $array = [];
    foreach ($articles as $article):
        $articleid = (int) $article["Id"];
        $quantity = (int) $_SESSION["cart"][$article["Id"]]["quantity"];
        echo $_SESSION["cart"][$article["Id"]]["quantity"];
        array_push($array, createOrderDetails($articleid, $quantity));
    endforeach;
    return $array;
}


function addMoney(int $amount) {
    $user = getUserById($_SESSION["user"]);
    $newValue = (float) $user["Balance"] + (float) $amount;
    if ($amount <= 0) {
        echo "Montant invalide";
        return;
    }
    updateUserBalance($_SESSION["user"], $newValue);
    var_dump($_SESSION["user"]);
}

function removeMoney(int $amount) {
    $user = getUserById($_SESSION["user"]);
    $newValue = (float) $user["Balance"] - (float) $amount;
    updateUserBalance($_SESSION["user"], $newValue);
    var_dump($_SESSION["user"]);
}


command();





?>