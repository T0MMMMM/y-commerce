<?php 

require_once dirname(__DIR__) . '/config/config.php';

function getCommandsByUserId(int $userId): array {
    global $conn;
    $sql = "SELECT * FROM order WHERE user_id = ?";  
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Erreur de préparation SQL: " . $conn->error);
        return [];
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $commands = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $commands;
}

function getOrderById(int $idCommand) {
    global $conn;
    $sql = "SELECT * FROM `order` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCommand);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $stmt->close();
    return $order;
}

function getOrderDetailsById(int $idCommand) {
    global $conn;
    $sql = "SELECT * FROM `order_details` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCommand);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();
    $stmt->close();
    return $order;
}

function getAllCommandsByUserId($userId) {
    global $conn;
    $sql = "SELECT * FROM `order` WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erreur de préparation : " . $conn->error);
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row["article_list"] = json_decode($row["article_list"], true);
            $orders[] = $row;
        }
    }
    $stmt->close();
    return $orders;
}


function createOrderDetails(int $ArticleId, int $Quantity): int {
    global $conn;
    $sql = "INSERT INTO order_details (article_id, quantity) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $ArticleId, $Quantity);
    $stmt->execute();
    $insertedId = $conn->insert_id; 
    $stmt->close();
    return $insertedId;
}

function createOrder(int $userId, int $totalAmount, array $articlesList): array {
    global $conn;
    $sql = "INSERT INTO `order` (user_id, transaction_date, total_price, article_list, adress) 
        VALUES (?, NOW(), ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $value = json_encode($articlesList);
    $city = "Montpellier";
    $stmt->bind_param( "iiss", $userId, $totalAmount,  $value, $city);
    
    $reponse = $stmt->execute();
    $insertedId = $conn->insert_id; 
    $stmt->close();
    return [$reponse, $insertedId];
}



?>