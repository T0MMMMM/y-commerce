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

function getUserByName($name) {
    global $conn;
    $sql = "SELECT * FROM user WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name); 
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    return $user;
}

function getArticleById($id) {
    global $conn;
    $sql = "SELECT a.*, u.Username as Author 
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
    $sql = "INSERT INTO user (Username, Password, Balance, Avatar, Role, Wishlist) VALUES (?, ?, ?, ?, ?, ?)";
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
    $stmt->execute();
    $stmt->close();
}

$jsonData = json_encode([
    "wishlist" => ["movies", "sports"]
]);
$role = json_encode([
    "role" => ["user"]
]);
//postArticle("Guitare", "instrument", "instrument de musique", 100);

?>