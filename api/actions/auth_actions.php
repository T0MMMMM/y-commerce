<?php

require_once dirname(__DIR__) . "/utils/auth_utils.php";
require_once dirname(__DIR__) . "/utils/user_utils.php";
require_once dirname(__DIR__) . "/crud/crud_user.php";
require_once dirname(__DIR__) . '/utils/utils.php';

if (!basename($_SERVER['PHP_SELF']) == 'auth_actions.php'){
          exit;
}
if (!isset($_SESSION)) {
          session_start();
}


$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$action = $data["action"] ?? null;

$username = $data["username"] ?? null;
$password = $data["password"] ?? null;
$comfirmPassword = isset($data["confirm_password"]) ?? null;
$role = json_encode(["role" => ["user"]]);

switch ($action) {
          case 'login':

                    $user = getUserByName($username);

                    checkAuthData($username, $password);

                    checkUser($user, $password);

                    $_SESSION["user"] = $user["id"];

                    sendSuccess(200, "Login success");

                    break;
          case "register":

                    checkAuthData($username, $password);

                    confirmPassword($password, $comfirmPassword);

                    checkUsernameLength($username);

                    existUsername($username);

                    $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);

                    $response = postUser($Username, $hashedPassword, $role);

                    // LOGIN

                    checkAuthData($username, $password);

                    checkUser($username, $password);

                    $_SESSION["user"] = $user["id"];

                    sendSuccess(200, "Login success");
                    
          default:
                    sendError(400, 'Invalid action');
                    break;
}
exit;

?>