<?php

require_once dirname(__DIR__) . "/utils/utils.php";
require_once dirname(__DIR__) . "/utils/admin_utils.php";
require_once dirname(__DIR__) . "/crud/crud_article.php";

if (!isset($_SESSION)) {
          session_start();
}


function isLogin() {
          if (!isset($_SESSION['user'])) { sendError(400, 'Login required'); }
}

function checkArticleData($article_data) {
          if (is_null($article_data))
                    sendError(400, 'Article data required');

          if (is_null($article_data['name'])|| is_null($article_data['slug']) || is_null($article_data['description']) || is_null($article_data['price']) || is_null($article_data['image_link'])) 
                    sendError(400, 'Invalid article data');
}

function checkArticle($article) {
          if (is_null($article)) 
                    sendError(400, 'Article not found');

          if ($article['owner_id'] !== $_SESSION['user'] && !isAdmin($_SESSION['user']))
                    sendError(400, 'Unauthorized');
}

?>