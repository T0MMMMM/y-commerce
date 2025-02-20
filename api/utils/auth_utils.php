<?php

require_once dirname(__DIR__) . "/crud/crud_user.php";
require_once dirname(__DIR__) . "/utils/utils.php";
require_once dirname(__DIR__) . "/crud/crud_article.php";

function checkAuthData($username, $password) {
          if (empty($username) || empty($password))
                    sendError(400, "Username and Password are required");
}

function checkUser($user, $password) {
          if (empty($user))
                    sendError(400, "Username is incorrect");
          if (!password_verify($password, $user['password']))
                    sendError(400, "Password is incorrect");
}

function confirmPassword($password, $confirmPassword) {
          if ($password != $confirmPassword)
                    sendError(400, "Passwords do not match");
          if (strlen($password) < 5)
                    sendError(400, "Password must be at least 5 characters");
}

function checkUsernameLength($username) {
          if (strlen($username) < 5 || strlen($username) > 20 )
                    sendError(400, "Username must be between 5 and 20 characters");
}

?>