<?php

require_once dirname(__DIR__) . "/utils/utils.php";
require_once dirname(__DIR__) . "/crud/crud_article.php";
require_once dirname(__DIR__) . "/crud/crud_command.php";

if (!isset($_SESSION)) {
          session_start();
}

function getTotal($cart) {
          $total = 0;
          foreach ($cart as $article)
                    $total += $article["price"]*$_SESSION["cart"][$article["id"]]["quantity"];
          return $total;
}

function checkCart($total) {
          if ($total == 0) 
                    sendError(400, "Empty Cart");
}

function checkBalance($total, $user) {
          if ($total > $user["balance"])
                    sendError(400, "Insufficient balance");
}

function createCommand($cart, $total) {

          $array = createDetailsCommand($cart);

          $response = createOrder($_SESSION["user"],$total, $array);

          return $response;
}
      
function createDetailsCommand($cart): array {
          $array = [];

          foreach ($cart as $article) {

                    $quantity = (int) $_SESSION["cart"][$article["id"]]["quantity"];

                    array_push($array, createOrderDetails( ((int) $article["id"]), $quantity));
          }

          return $array;
}

?>