<?php

require_once dirname(__DIR__) . "/utils/cart_utils.php";
require_once dirname(__DIR__) . '/utils/utils.php';

if (!basename($_SERVER['PHP_SELF']) == 'cart_actions.php'){
          exit;
}
if (!isset($_SESSION)) {
          session_start();
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$action = $data["action"] ?? null;

$product_id = $data['product_id'] ?? null;
$quantity_change = $data['quantity_change'] ?? null;


switch ($action) {
          case 'add_to_cart':
                    addToCart($product_id);
                    sendSuccess(200, "Article added to cart");
                    break;
          case 'remove_from_cart':
                    removeFromCart($product_id);
                    sendSuccess(200, "Article removed from cart");
                    break;
          case 'update_cart':
                    updateCart($product_id, $quantity_change);
                    sendSuccess(200, "Article updated in cart");
                    break;
          case 'clear_cart':
                    clearCart();
                    sendSuccess(200, "Cart cleared");
                    break;
          case 'getCart':
                    getCart();
                    sendSuccess(200, "Cart retrieved");
                    break;
          default:
                    sendError(400, 'Invalid action');
                    break;
}
exit;
?>