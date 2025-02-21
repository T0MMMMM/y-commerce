<?php
require_once dirname(__DIR__) . '/config/config.php';

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

function getUserByName($username) {
    global $conn;
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
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

function postUser($Username, $mail, $Password, $Role) {
    global $conn;
    $sql = "INSERT INTO user (username, mail, password, balance, profil_image, role, wishlist, creation_date, modification_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), null)";
    $stmt = $conn->prepare($sql);
    $Balance = 0;
    $Avatar = "";
    $Wishlist = json_encode(["wishlist" => []]);
    $stmt->bind_param("sssisss",$Username, $mail, $Password, $Balance, $Avatar, $Role, $Wishlist);
    $stmt->execute();
    $stmt->close();
}

function updateUserProfile($userId, $username) {
    global $conn;
    $sql = "UPDATE user SET username = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $username, $userId);
    updateUserModificationDate($userId);
    $response = $stmt->execute();
    $stmt->close();
    return $response;
}


function updateUserBalance(int $id, $value) {
    global $conn;
    $sql = "UPDATE user SET balance = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $value, $id);
    $response = $stmt->execute();
    $stmt->close();
    return $response;
}

function updateUserModificationDate(int $id) {
    global $conn;
    $sql = "UPDATE user SET modification_date = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function updateUserPassword($userId, $newPassword) {
    global $conn;
    $sql = "UPDATE user SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newPassword, $userId);
    return $stmt->execute();
}

function deleteUser($userId) {
    global $conn;
    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

?>