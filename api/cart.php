<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once "crud.php";

function addToCart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            'quantity' => 1
        ];
    }
}

function removeFromCart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    } else {
        echo "Article non trouvé dans le panier !";
    }
}

function updateCart($product_id, $quantity) {
    if (isset($_SESSION['cart'][$product_id])) {
        if ($quantity > 0) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        } else {
            removeFromCart($product_id);
        }
    } else {
        echo "Article non trouvé dans le panier !";
    }
}

function clearCart() {
    unset($_SESSION['cart']);
}

function getCart() {
    if (empty($_SESSION['cart'])) {
            return "Votre panier est vide.";
    }
    $cart = [];
    foreach ($_SESSION["cart"] as $key => $value) {
            $cart[] = getArticleById($key);
    }
    return $cart;
}


if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add_to_cart':
            addToCart($_POST['product_id']);
            break;
        case 'remove_from_cart':
            removeFromCart($_POST['product_id']);
            break;
        case 'update_cart':
            updateCart($_POST['product_id'], $_POST['quantity']);
            break;
        case 'clear_cart':
            clearCart();
            break;
        case 'getCart':
            getCart();
            break;
    }
    if (isset($_POST["path"])) {
        header("Location: http://localhost/y-commerce" . $_POST["path"]);
        exit();
    }
}

?>