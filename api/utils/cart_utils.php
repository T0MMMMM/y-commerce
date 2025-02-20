<?php
require_once dirname(__DIR__) . "/utils/utils.php";
require_once dirname(__DIR__) . "/crud/crud_article.php";

if (!isset($_SESSION)) {
    session_start();
}

function addToCart($product_id) {
    if (isset($_SESSION['cart'][$product_id]))
        $_SESSION['cart'][$product_id]['quantity']++;
    else 
        $_SESSION['cart'][$product_id] = ['quantity' => 1];
}

function removeFromCart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) 
        unset($_SESSION['cart'][$product_id]);
    else
        sendError(400, "Article not found in cart");
}
      
function updateCart($product_id, $quantity_change) {
    if (isset($_SESSION['cart'][$product_id])) {

        $_SESSION['cart'][$product_id]['quantity'] += $quantity_change;

        if ($_SESSION['cart'][$product_id]['quantity'] <= 0) 
            removeFromCart($product_id);
    } else
        sendError(400, "Article not found in cart");
          
}
      
function clearCart() {
    unset($_SESSION['cart']);
}
      
function getCart() {
    if (empty($_SESSION['cart']))
        return [];
          
    $cart = [];

    foreach ($_SESSION["cart"] as $key => $value)
        $cart[] = getArticleById($key);
          
    return $cart;
}

?>