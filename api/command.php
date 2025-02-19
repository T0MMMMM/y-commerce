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
        $articleid = (int) $article["Id"];
        $quantity = (int) $_SESSION["cart"][$article["Id"]]["quantity"];
        echo $_SESSION["cart"][$article["Id"]]["quantity"];
        array_push($array, createOrderDetails($articleid, $quantity));
    endforeach;
    return $array;
}

function updateBalance($id, int $amount) {
    $user = getUserById($id);
    $newValue = (float) $user["Balance"] + (float) $amount;
    updateUserBalance($_SESSION["user"], $newValue);
}

if (isset($_POST["action"]) && $_POST["action"] == "create_command") {
    command();
}

$user = getUserById($_SESSION['user']);


?>