<?php 

require_once 'config.php';


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

function createArticle($data) {
    global $conn;
    $sql = "INSERT INTO article (Name, Slug, Description, Price, Image_link, Id_owner, Publication_Date, Modification_Date) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsi", 
        $data['name'],
        $data['slug'],
        $data['description'],
        $data['price'],
        $data['image_link'],
        $data['id_owner']
    );
    
    if ($stmt->execute()) {
        $id = $conn->insert_id;
        $stmt->close();
        return $id;
    }
    
    $stmt->close();
    return false;
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

function updateArticle($data) {
    global $conn;
    $sql = "UPDATE article SET 
            Name = ?, 
            Slug = ?, 
            Description = ?, 
            Price = ?, 
            Image_link = ?,
            Modification_Date = NOW()
            WHERE Id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsi", 
        $data['name'],
        $data['slug'],
        $data['description'],
        $data['price'],
        $data['image_link'],
        $data['id']
    );
    
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}


?>