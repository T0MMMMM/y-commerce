<?php
session_start();
require_once 'crud.php';

header('Content-Type: application/json');

// Vérifier si la requête est en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// Récupérer les données envoyées
$data = json_decode(file_get_contents('php://input'), true);

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

// Traiter les différentes actions
switch ($data['action']) {
    case 'update_balance':
        if (!isset($data['amount']) || !is_numeric($data['amount'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid amount']);
            exit();
        }
        
        $user = getUserById($_SESSION['user']);
        $newBalance = $user['Balance'] + $data['amount'];
        updateUserBalance($user['Id'], $newBalance);
        echo json_encode(['success' => true, 'newBalance' => $newBalance]);
        break;

    case 'update_profile':
        if (!isset($data['username']) || empty(trim($data['username']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid username']);
            exit();
        }
        
        updateUserProfile($_SESSION['user'], $data['username']);
        echo json_encode(['success' => true, 'newUsername' => $data['username']]);
        break;

    case 'logout':
        session_destroy();
        echo json_encode(['success' => true]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
        break;
}
