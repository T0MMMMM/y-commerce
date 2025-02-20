<?php 

require_once 'cart.php';

function command() {
    $total = 0;
    $response = [];
    $response['success'] = false;
    $cart = getCart();
    foreach ($cart as $article) {
        $total += $article["price"]*$_SESSION["cart"][$article["id"]]["quantity"];
    }
    $user = getUserById($_SESSION["user"]);
    if ($total == 0) {
        $response['error'] = "Votre Panier est vide";
        echo json_encode($response);
        exit();
    }
    if ($total > $user["balance"]) {
        $response['error'] = "Solde insuffisant";
        echo json_encode($response);
        exit();
    } else {
        createCommand($total);
        updateBalance($_SESSION["user"], -$total);
        clearCart();
    }
    $response['success'] = true;
    echo json_encode($response);
    exit();
}

function createCommand($total) {
    $cart = getCart();
    $array = createDetailsCommand($cart);
    $userId = $_SESSION["user"];
    $commandid = createOrder($userId,$total, $array);
}

function createDetailsCommand($articles): array {
    $array = [];
    foreach ($articles as $article) {
        $articleid = (int) $article["id"];
        $quantity = (int) $_SESSION["cart"][$article["id"]]["quantity"];
        array_push($array, createOrderDetails($articleid, $quantity));
    }
    return $array;
}

function updateBalance($id, int $amount) {
    $user = getUserById($id);
    $newValue = (float) $user["balance"] + (float) $amount;
    updateUserBalance($id, $newValue);
}

if (isset($_POST["action"]) && $_POST["action"] == "create_command") {
    command();
}


?>