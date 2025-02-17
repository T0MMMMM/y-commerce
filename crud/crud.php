<?php 

require_once '../config/config.php';


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

function getArticleById($id) {
    global $conn;
    $sql = "SELECT * FROM article WHERE id = $id";
    $result = $conn ->query($sql);
    $article = $result->fetch_assoc();
    return $article;
}





postArticle("Guitare", "instrument", "instrument de musique", 100);


?>