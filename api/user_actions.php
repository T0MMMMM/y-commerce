<?php
session_start();
require_once 'crud.php';
require_once 'command.php';

// Traiter les différentes actions
switch ($_POST['action']) {
    case 'update_balance':
        if (!isset($_POST['amount']) || !is_numeric($_POST['amount'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid amount']);
            exit();
        }
        updateBalance($_POST['amount']);
        echo "dddd";
        break;

    case 'update_profile':
        if (!isset($_POST['username']) || empty(trim($_POST['username']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid username']);
            exit();
        }
        
        updateUserProfile($_SESSION['user'], $_POST['username']);
        echo json_encode(['success' => true, 'newUsername' => $_POST['username']]);
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
