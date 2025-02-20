<?php

require_once dirname(__DIR__) . "/utils/user_utils.php";
require_once dirname(__DIR__) . "/crud/crud_user.php";
require_once dirname(__DIR__) . '/utils/utils.php';

if (!basename($_SERVER['PHP_SELF']) == 'user_actions.php'){
          exit;
}
if (!isset($_SESSION)) {
    session_start();
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$action = $data["action"] ?? null;

$id = $data["id"] ?? null;
$user = is_null($id) ? null : getUserById($id);
$balance_amount = $data["balance_amount"] ?? null;
$username = $data["username"] ?? null;
$currentPassword = $data["currentPassword"] ?? null;
$newPassword = $data["newPassword"] ?? null;


switch ($action) {
          case 'update_balance':
                    validateBalance((float) $balance_amount);
                    
                    $response = updateUserBalance($id, ((float) $user["balance"] + (float) $balance_amount));

                    if ($response)
                              sendSuccess(200, "Balance updated");
                    else
                              sendError(400, "Error updating balance");
                    break;

          case 'update_profile':

                    validateUsername($username);

                    existUsername( $username);

                    $response = updateUserProfile($id,  $username);

                    if ($response)
                              sendSuccess(200,'Profile updated');
                    else
                              sendError(400, "Error updating profile");
                    break;

          case 'update_password':

                    validatePasswords($user["password"],  $currentPassword, $newPassword );

                    $response = updateUserPassword($id, $currentPassword, $newPassword);

                    if ($response)
                              sendSuccess(200, "Password updated");
                    else
                              sendError(400, "Error updating password");
                    break;

          case 'logout':
                    session_destroy();

                    sendSuccess(200, "Logout success");
                    break;

          default:
                    sendError(400, 'Invalid action');
                    break;
}
exit;
?>