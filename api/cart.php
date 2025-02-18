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

function updateCart($product_id, $quantity_change) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity_change;
        if ($_SESSION['cart'][$product_id]['quantity'] <= 0) {
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
        return [];
    }
    $cart = [];
    foreach ($_SESSION["cart"] as $key => $value) {
        $cart[] = getArticleById($key);
    }
    return $cart;
}

if (isset($_POST['action'])) {
    $product_id = $_POST['product_id'] ?? null;
    $quantity_change = $_POST['quantity_change'] ?? null;

    switch ($_POST['action']) {
        case 'add_to_cart':
            addToCart($product_id);
            break;
        case 'remove_from_cart':
            removeFromCart($product_id);
            break;
        case 'update_cart':
            updateCart($product_id, $quantity_change);
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