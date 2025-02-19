<?php 

require_once 'cart.php';

function command() {
    $total = 0;
    $cart = getCart();
    foreach ($cart as $article):
        $total += $article["price"]*$_SESSION["cart"][$article["id"]]["quantity"];
    endforeach;
    $user = getUserById($_SESSION["user"]);
    if ($total > $user["balance"]) {
        echo "Solde insuffisant";
        return;
    } else {
        createCommand($total);
        updateBalance(-$total);
        clearCart();
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
        $articleid = (int) $article["id"];
        $quantity = (int) $_SESSION["cart"][$article["id"]]["quantity"];
        echo $_SESSION["cart"][$article["id"]]["quantity"];
        array_push($array, createOrderDetails($articleid, $quantity));
    endforeach;
    return $array;
}

function updateBalance(int $amount) {
    $user = getUserById($_SESSION["user"]);
    $newValue = (float) $user["balance"] + (float) $amount;
    updateUserBalance($_SESSION["user"], $newValue);
}

if (isset($_POST["action"]) && $_POST["action"] == "create_command") {
    command();
}

$user = getUserById($_SESSION['user']);


?>