<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once 'config.php';
require_once 'crud.php';


$test = json_encode(["role" => ["user"]]);


function register($Username, $Password, $role) {
    global $key;
    if (empty($Username) || empty($Password)) {
        echo "Username and Password are required";
        return;
    }
    if (strlen($Username) < 5 || strlen($Username) > 20 ) {
        echo "Username must be between 5 and 20 characters";
        return;
    }
    if (strlen($Password) < 5) {
        echo "Password must be at least 5 characters";
        return;
    }
    if (!getUserByName($Username) > 0) {
        $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);
        postUser($Username, $hashedPassword, $role);
        login($Username, $Password);
    } else {
        echo "Username already exists";
    }
}


function login($Username, $Password) {
    if (empty($Username) || empty($Password)) {
        echo "Username and Password are required";
        return;
    }
    $user = getUserByName($Username);
    if (empty($user)) {
        echo "Username does not exist";
        return;
    }
    if (!password_verify($Password, $user['Password'])) {
        echo "Password is incorrect";
        return;
    }
    $_SESSION["user"] = $user["id"];
}


if (isset($_POST["action"]) && $_POST["action"] == "login") {
    if (isset($_POST["username"]) && $_POST["password"]) {
        login($_POST["username"], $_POST["password"]);
    }
} if (isset($_POST["action"]) && $_POST["action"] == "register") {
    if (isset($_POST["username"]) && $_POST["password"]) {
        register($_POST["username"], $_POST["password"], $test);
    }
}

// header("Location: http://localhost/y-commerce/");
// exit();


//register("Victor","michel", $test);
//login("dylan", "saboteur97");




