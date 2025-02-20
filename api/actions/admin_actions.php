<?php

require_once dirname(__DIR__) . "/utils/admin_utils.php";
require_once dirname(__DIR__) . '/crud/crud_article.php';
require_once dirname(__DIR__) . '/crud/crud_user.php';
require_once dirname(__DIR__) . '/utils/utils.php';

if (!basename($_SERVER['PHP_SELF']) == 'admin_actions.php'){
          exit;
}
if (!isset($_SESSION)) {
          session_start();
}

if (!isAdmin($_SESSION["user"])) {
          sendError(400,"Access denied");
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$action = $data["action"] ?? null;

$article_id = $data["article_id"] ?? null;
$user_id = $data["user_id"] ?? null;


switch ($action) {
          case 'delete_article':

                    checkId($article_id);

                    $response = removeArticle($article_id);

                    if ($response) 
                              sendSuccess(200, "Article removed");
                    else 
                              sendError(400, "Error removing article");
                    break;

          case 'delete_user':

                    checkId($user_id);

                    checkSelfDelete($user_id);

                    if (!removeUserArticles($user_id))
                              sendError(400, "Error removing user articles");

                    $response = deleteUser($user_id);

                    if ($response)
                              sendSuccess(200, "User removed");
                    else
                              sendError(400, "Error removing user");
                    break;

          default:
                    sendError(400, 'Invalid action');
                    break;
}
exit;

?>
