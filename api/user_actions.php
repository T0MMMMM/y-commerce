<?php
session_start();
require_once "crudArticles.php";
require_once "crudCommands.php";
require_once "crudUser.php";
require_once 'command.php';

switch ($_POST['action']) {
    case 'update_balance':
        if (!isset($_POST['amount']) || !is_numeric($_POST['amount'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid amount']);
            exit();
        }
        updateBalance($_POST['id'], $_POST['amount']);
        echo json_encode(['success' => true]);
        break;

    case 'update_profile':
        if (!isset($_POST['username']) || empty(trim($_POST['username']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid username']);
            exit();
        }
        $user = getUserById($_POST['id']);
        if (!getUserByName($_POST["username"]) > 0) {
            updateUserProfile($_POST['id'], $_POST['username']);
            echo json_encode(['success' => true, 'newUsername' => $_POST['username']]);
        } else {
            echo json_encode(['error' => 'Username arleady used']);
            exit();
        }
        break;

    case 'update_password':
        if (!isset($_POST['currentPassword']) || !isset($_POST['newPassword'])) {
            echo json_encode(['error' => 'Données manquantes']);
            exit();
        }
        
        if (strlen($_POST['newPassword']) < 5) {
            $response['success'] = false;
            $response['error'] = "New Password must be at least 5 characters";
            echo json_encode($response);
            exit();
        }        
        if (updateUserPassword($_POST['id'], $_POST['currentPassword'], $_POST['newPassword'])) {
            echo json_encode(['success' => false]);
        } else {
            echo json_encode(['error' => 'Mot de passe actuel incorrect']);
        }
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
exit();