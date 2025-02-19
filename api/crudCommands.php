<?php 

require_once 'config.php';

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

function createOrder(int $userId, int $totalAmount, array $articlesList): int {
    global $conn;
    $sql = "INSERT INTO `order` (user_id, transaction_date, total_price, article_list, adress) 
        VALUES (?, NOW(), ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $value = json_encode($articlesList);
    $city = "Montpellier";
    var_dump($city);
    $stmt->bind_param( "iiss", $userId, $totalAmount,  $value, $city);
    

    if (!$stmt->execute()) {
        echo ("Erreur d'exécution SQL: " . $stmt->error);
        $stmt->close();
        return -1;
    }
    $insertedId = $conn->insert_id; 
    $stmt->close();
    return $insertedId;
}



?>