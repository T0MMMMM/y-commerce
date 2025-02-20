<?php 

require_once dirname(__DIR__) . '/config/config.php';


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

function postArticle($data) {
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
    
    $response = $stmt->execute();
    $stmt->close();
    return $response;
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

function putArticle($data) {
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

function removeArticle($articleId) {
    global $conn;
    $sql = "DELETE FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $articleId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function removeUserArticles($userId) {
    global $conn;
    $sql = "DELETE FROM article WHERE owner_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// $jsonData = file_get_contents('php://input');
// $data = json_decode($jsonData, true);

// switch ($_SERVER['REQUEST_METHOD']) {
//     case 'GET':
//         echo getAllArticles();
//         break;
//     case 'POST':
//         echo postArticle($data);
//         break;
//     case 'PUT':
//         echo putArticle($data);
//         break;
//     case 'DELETE':
//         echo removeArticle($data['id']);
//         break;  
//     default:
//         http_response_code(400);
//         echo json_encode([
//                 "status" => "error",
//                 "error" => "Invalid Request",
//         ]);
//         break;
// }

?>