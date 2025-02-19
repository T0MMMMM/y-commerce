<?php 

require_once 'config.php';


function getArticleById($id) {
    global $conn;
    $sql = "SELECT a.*, u.username as Author, u.id as AuthorId
            FROM article a 
            LEFT JOIN user u ON a.owner_id = u.id 
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

function createArticle($data) {
    global $conn;
    $sql = "INSERT INTO article (name, slug, description, price, image_link, owner_id, publication_date, modification_date) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdsi", 
        $data['name'],
        $data['slug'],
        $data['description'],
        $data['price'],
        $data['image_link'],
        $data['owner_id']
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
    $sql = "SELECT a.*, u.username as Author 
            FROM article a 
            JOIN user u ON a.owner_id = u.id 
            WHERE a.owner_id = ? 
            ORDER BY a.publication_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateArticle($data) {
    global $conn;
    $sql = "UPDATE article SET 
            name = ?, 
            slug = ?, 
            description = ?, 
            price = ?, 
            image_link = ?,
            modification_date = NOW()
            WHERE id = ?";
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

function deleteArticle($articleId) {
    global $conn;
    $sql = "DELETE FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $articleId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function deleteUserArticles($userId) {
    global $conn;
    $sql = "DELETE FROM article WHERE owner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

?>