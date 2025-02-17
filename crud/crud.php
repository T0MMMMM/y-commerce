<?php 

require_once 'config/config.php';

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






?>