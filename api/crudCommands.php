<?php 

require_once 'config.php';

function getCommandsByUserId(int $userId): array {
    global $conn;
    $sql = "SELECT * FROM orders WHERE id_user = ?";  
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
    $sql = "INSERT INTO order_details (Id_article, Article_number) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $ArticleId, $Quantity);
    $stmt->execute();
    $insertedId = $conn->insert_id; 
    $stmt->close();
    return $insertedId;
}

function createOrder(int $userId, int $totalAmount, array $articlesList): int {
    global $conn;
    $sql = "INSERT INTO orders (id_user, Transaction_date, Total_amount, Articles_list, Address, Place, CP) 
        VALUES (?, NOW(), ?, ?, address, place, cp)";
    $stmt = $conn->prepare($sql);
    $out = array_values($articlesList);
    $value = json_encode($out);
    $stmt->bind_param("iis", $userId, $totalAmount, $value);

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