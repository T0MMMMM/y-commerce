<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once 'config.php';
require_once "crudArticles.php";
require_once "crudCommands.php";
require_once "crudUser.php";

function register($Username, $Password, $ConfirmPassword, $role) {
    global $key;
    $response = [];
    $response['success'] = true;
    if (empty($Username) || empty($Password)) {
        $response['success'] = false;
        $response['error'] = "Username and Password are required";
        echo json_encode($response);
        return;    
    }
    if ($Password != $ConfirmPassword) {
        $response['success'] = false;
        $response['error'] = "Passwords must match";
        echo json_encode($response);
        return;    
    }
    if (strlen($Username) < 5 || strlen($Username) > 20 ) {
        $response['success'] = false;
        $response['error'] = "Username must be between 5 and 20 characters";
        echo json_encode($response);
        return;    
    }
    if (strlen($Password) < 5) {
        $response['success'] = false;
        $response['error'] = "Password must be at least 5 characters";
        echo json_encode($response);
        return;   
    }
    if (!getUserByName($Username) > 0) {
        $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);
        postUser($Username, $hashedPassword, $role);
        login($Username, $Password);
        return; 

    } else {
        $response['success'] = false;
        $response['error'] = "Username already exists";
        echo json_encode($response);
        return; 
    }
}

function login($Username, $Password) {
    $response = [];
    if (empty($Username) || empty($Password)) {
        $response['success'] = false;
        $response['error'] = "Username and Password are required";
        echo json_encode($response);
        return;    
    }
    $user = getUserByName($Username);
    if (empty($user)) {
        $response['success'] = false;
        $response['error'] = "Username already in use";
        echo json_encode($response); 
        return;       
    }
    if (!password_verify($Password, $user['Password'])) { 
        $response['success'] = false;
        $response['error'] = "Password is incorrect";;
        echo json_encode($response);
        return;    
    }
    $response['success'] = true;
    echo json_encode($response);
    $_SESSION["user"] = $user["Id"];
}

if (isset($_POST["action"]) && $_POST["action"] == "login") {
    if (isset($_POST["username"]) && $_POST["password"]) {
        login($_POST["username"], $_POST["password"]);
    }
} if (isset($_POST["action"]) && $_POST["action"] == "register") {
    if (isset($_POST["username"]) && $_POST["password"] && $_POST["confirm_password"]) {
        register($_POST["username"], $_POST["password"], $_POST["confirm_password"], role: json_encode(["role" => ["user"]]));
    }
}







