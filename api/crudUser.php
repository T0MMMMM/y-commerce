<?php




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

function getUserByName($name) {
    global $conn;
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
}

function getUserRoles(int $userId) {
    global $conn;
    $sql = "SELECT role FROM user WHERE id = ?";  
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Erreur de préparation SQL: " . $conn->error);
        return [];
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $roles = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $decoded = json_decode($roles[0]["role"], true);
    return ($decoded);
}

// // Une fois l'utilisateur authentifié :
// $userId = $_SESSION['user_id']; // ID de l'utilisateur après connexion
// $userRoles = getUserRoles($userId, $pdo);



function postUser($Username, $Password, $Role) {
    global $conn;
    $mail = "test@gmaiL.com";
    $sql = "INSERT INTO user (username, mail, password, balance, profil_image, role, wishlist, creation_date, modification_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), null)";
    $stmt = $conn->prepare($sql);
    $Balance = 0;
    $Avatar = "";
    $Wishlist = json_encode(["wishlist" => []]);
    $stmt->bind_param("sdsisss",$Username, $Password, $mail, $Balance, $Avatar, $Role, $Wishlist);
    if ($stmt->execute()) {
        return $conn->insert_id;
    } else {
        echo "failed to create user: " . $stmt->error;
    }
    $stmt->close();
}

function updateUserProfile($userId, $username) {
    global $conn;
    $sql = "UPDATE user SET username = ? WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $userId);
    updateUserModificationDate($userId);
    $stmt->execute();
    $stmt->close();
}


function updateUserBalance(int $id, $value) {
    global $conn;
    $sql = "UPDATE user SET balance = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $value, $id);
    $stmt->execute();
    $stmt->close();
}

function updateUserModificationDate(int $id) {
    global $conn;
    $sql = "UPDATE user SET modification_date = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function updateUserPassword($userId, $currentPassword, $newPassword) {
    global $conn;
    $user = getUserById($userId);
    if (!password_verify($currentPassword, $user['password'])) {
        return false;
    }
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET password = ? WHERE id = ?";
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



?>