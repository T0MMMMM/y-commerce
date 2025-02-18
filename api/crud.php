<?php 

require_once 'config.php';


function postArticle($name, $slug, $description, $price) {
    global $conn;
    $sql = "INSERT INTO article (Name, Slug, Description, Price, Publication_Date, Modification_Date) 
        VALUES (?, ?, ?, ?, NOW(), NOW())";   
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssd", $name, $slug, $description, $price);
    if ($stmt->execute()) {
        echo "good";
        return $conn->insert_id;
    } else {
        echo "failed to create article";
    }
    $stmt->close();
}

function getAllArticles() {
    global $conn;

    $sql = "SELECT * FROM article";
    $result = $conn ->query($sql);
    $articles = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
    }
    return $articles;
}

function getAllUsers() {
    global $conn;

    $sql = "SELECT * FROM user";
    $result = $conn ->query($sql);
    $users = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    return $users;
}

function getArticlesByName($name) {
    global $conn;
    $sql = "SELECT * FROM article WHERE name LIKE '%$name%'";
    $result = $conn ->query($sql);
    $articles = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
    }
    return $articles;
}

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


function getUserByName($name) {
    global $conn;
    $sql = "SELECT * FROM user WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
}

function getArticleById($id) {
    global $conn;
    $sql = "SELECT a.*, u.Username as Author, u.Id as AuthorId
            FROM article a 
            LEFT JOIN user u ON a.Id_owner = u.Id 
            WHERE a.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();
    $stmt->close();
    return $article;
}

function postUser($Username, $Password, $Role) {
    global $conn;
    $sql = "INSERT INTO user (Username, Password, Balance, Avatar, Role, Wishlist, Creation_Date, Modification_Date) VALUES (?, ?, ?, ?, ?, ?, NOW(), null)";
    $stmt = $conn->prepare($sql);
    $Balance = 0;
    $Avatar = "";
    $Wishlist = json_encode(["wishlist" => []]);
    $stmt->bind_param("ssisss",$Username, $Password, $Balance, $Avatar, $Role, $Wishlist);
    if ($stmt->execute()) {
        return $conn->insert_id;
    } else {
        echo "failed to create user: " . $stmt->error;
    }
    $stmt->close();
}

function getUserById($id) {
    global $conn;
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
}

function updateUserProfile($userId, $username) {
    global $conn;
    $sql = "UPDATE user SET Username = ? WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $userId);
    updateUserModificationDate($userId);
    $stmt->execute();
    $stmt->close();
}


function updateUserBalance(int $id, $value) {
    global $conn;
    $sql = "UPDATE user SET Balance = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $value, $id);
    $stmt->execute();
    $stmt->close();
}

function updateUserModificationDate(int $id) {
    global $conn;
    $sql = "UPDATE user SET Modification_Date = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
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

function getUserArticles($userId) {
    global $conn;
    $sql = "SELECT a.*, u.Username as Author 
            FROM article a 
            JOIN user u ON a.Id_owner = u.Id 
            WHERE a.Id_owner = ? 
            ORDER BY a.Publication_Date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateUserPassword($userId, $currentPassword, $newPassword) {
    global $conn;
    $user = getUserById($userId);
    
    if (!password_verify($currentPassword, $user['Password'])) {
        return false;
    }
    
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET Password = ? WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashedPassword, $userId);
    return $stmt->execute();
}

$jsonData = json_encode([
    "wishlist" => ["movies", "sports"]
]);
$role = json_encode([
    "role" => ["user"]
]);
//postArticle("Guitare", "instrument", "instrument de musique", 100);

?>