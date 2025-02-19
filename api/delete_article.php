<?php
session_start();
require_once 'config.php';
require_once 'admin.php';
require_once 'crudArticles.php';

if (!isAdmin()) {
    echo json_encode(['success' => false, 'message' => 'Accès non autorisé']);
    exit();
}

$articleId = isset($_POST['id']) ? $_POST['id'] : null;

if ($articleId && deleteArticle($articleId)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression']);
}
