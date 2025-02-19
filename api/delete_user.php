<?php
session_start();
require_once 'config.php';
require_once 'admin.php';
require_once 'crudUser.php';
require_once 'crudArticles.php';

if (!isAdmin()) {
    echo json_encode(['success' => false, 'message' => 'Accès non autorisé']);
    exit();
}

$userId = isset($_POST['id']) ? $_POST['id'] : null;

if ($userId) {
    if ($userId == $_SESSION['user']) {
        echo json_encode(['success' => false, 'message' => 'Impossible de supprimer votre propre compte']);
        exit();
    }

    if (!deleteUserArticles($userId)) {
          echo json_encode(['success' => false, 'message' => "Erreur lors de la suppression des articles du l'utilisateur"]);
          exit();
    }

    if (deleteUser($userId)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID non fourni']);
}
