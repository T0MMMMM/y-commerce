<?php
session_start();
require_once "crudArticles.php";
require_once "crudCommands.php";
require_once "crudUser.php";
require_once '../utils/utils.php';
require_once "admin.php";

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé']);
    exit();
}

switch ($_POST['action']) {
    case 'create':
        $articleData = [
            'name' => $_POST['name'],
            'slug' => createSlug($_POST['name']),
            'description' => $_POST['description'],
            'price' => floatval($_POST['price']),
            'image_link' => $_POST['image_link'],
            'id_owner' => $_SESSION['user']
        ];

        $result = createArticle($articleData);
        if ($result) {
            echo json_encode([
                'success' => true,
                'id' => $result,
                'slug' => $articleData['slug']
            ]);
        } else {
            echo json_encode(['error' => 'Erreur lors de la création']);
        }
        break;

    case 'update':
        $article = getArticleById($_POST['id']);
        if (!$article || $article['Id_owner'] !== $_SESSION['user'] && !isAdmin()) {
            echo json_encode(['error' => 'Non autorisé']);
            exit();
        }

        $articleData = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'slug' => createSlug($_POST['name']),
            'description' => $_POST['description'],
            'price' => floatval($_POST['price']),
            'image_link' => $_POST['image_link']
        ];

        if (updateArticle($articleData)) {
            echo json_encode([
                'success' => true,
                'slug' => $articleData['slug']
            ]);
        } else {
            echo json_encode(['error' => 'Erreur lors de la modification']);
        }
        break;

    default:
        echo json_encode(['error' => 'Action non reconnue']);
        break;
}
