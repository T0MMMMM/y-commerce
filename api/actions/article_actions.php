<?php

require_once dirname(__DIR__) . "/utils/article_utils.php";
require_once dirname(__DIR__) . '/crud/crud_article.php';
require_once dirname(__DIR__) . '/utils/utils.php';

if (!basename($_SERVER['PHP_SELF']) == 'article_actions.php'){
          exit;
}
if (!isset($_SESSION)) {
          session_start();
}

isLogin();

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$action = $data["action"] ?? null;

$id = $data["id"] ?? null;
$article = is_null($id) ? null : getArticleById($id);
//$article_data = $data["article_data"] ?? null;

$article_data =  [
          'name' => $data["name"] ?? null,
          'slug' => createSlug($data["name"] ?? null),
          'description' => $data["description"] ?? null,
          'price' => floatval($data["price"] ?? null),
          'image_link' => $data["image_link"] ?? null,
          'owner_id' => $_SESSION["user"],
          'id' => $id
      ];


switch ($action) {
          case 'create_article':
                    
                    checkArticleData($article_data);

                    $response = postArticle($article_data);

                    if ($response) 
                              sendSuccess(200, "Article created");
                    else 
                              sendError(400, "Error creating article");
                    break;

          case 'update_article':

                    checkArticle($article);

                    checkArticleData($article_data);

                    $response = putArticle($article_data);

                    if ($response)
                              sendSuccess(200, "Article updated");
                    else
                              sendError(400, "Error updating article");
                    break;

          default:
                    sendError(400, 'Invalid action');
                    break;
}
exit;
?>