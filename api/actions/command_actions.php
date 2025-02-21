<?php 

require_once dirname(__DIR__) . "/utils/command_utils.php";
require_once dirname(__DIR__) . "/utils/cart_utils.php";
require_once dirname(__DIR__) . "/crud/crud_user.php";
require_once dirname(__DIR__) . '/utils/utils.php';
require_once dirname(__DIR__) . '/utils/article_utils.php';

if (!basename($_SERVER['PHP_SELF']) == 'command_actions.php'){
          exit;
}
if (!isset($_SESSION)) {
          session_start();
}

isLogin();

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$action = $data["action"] ?? null;

switch ($action) {
          case 'create_command':

                    $cart = getCart();
                    $total = getTotal($cart);
                    
                    $user = getUserById($_SESSION["user"]);
                    $shipping_address = $data["shipping_address"] ?? null;

                    if (!$shipping_address) {
                              sendError(400, "Shipping address required");
                    }

                    $address = $shipping_address["address"] . ", " . 
                              $shipping_address["postal_code"] . " " . 
                              $shipping_address["city"];

                    checkCart($total);
                    checkBalance($total, $user);
                    
                    $response = createCommand($cart, $total, $address);
                    $command_id = $response[1];

                    if (!$response[0])
                              sendError(400, "Error creating command");

                    $responseBalance = updateUserBalance($_SESSION["user"], (float) $user["balance"] + (float) -$total);

                    if (!$responseBalance)
                              sendError(400, "Error updating balance");

                    clearCart();

                    sendSuccess(200, "Command created");
                    break;
          default:
                    sendError(400, 'Invalid action');
                    break;
}
exit;
?>