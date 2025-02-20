<?php
require_once dirname(__DIR__) . "/utils/utils.php";
require_once dirname(__DIR__) . "/crud/crud_article.php";


function validateUsername($username) {
    if (is_null($username) || empty(trim($username))) {
        sendError(400, "Username cannot be empty");
    }
}

function existUsername($username) {
    if (getUserByName($username) > 0) {
        sendError(400, "Username already exists");
    }
}

function validatePasswords($realCurrentPasswordHash, $currentPassword, $newPassword) {
    if (empty($currentPassword) || empty($newPassword)) {
        sendError(400, "Passwords cannot be empty");
    }
    if (strlen($newPassword) < 5) {
        sendError(400, "New password must be at least 5 characters long");
    }
    if (!password_verify($currentPassword, hash: $realCurrentPasswordHash)) {
        sendError(400, 'Incorrect current password');
    }
}

function validateBalance($balance) {
    if (!is_numeric($balance) || $balance < 0) {
        sendError(400, "Invalid balance amount");
    }
}

?>