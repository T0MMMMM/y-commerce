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
    $sql = "SELECT * FROM user WHERE Username = ?";
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

function deleteUser($userId) {
    global $conn;
    $sql = "DELETE FROM user WHERE Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

$jsonData = json_encode([
    "wishlist" => ["movies", "sports"]
]);
$role = json_encode([
    "role" => ["user"]
]);



?>