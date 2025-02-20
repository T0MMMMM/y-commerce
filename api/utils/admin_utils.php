<?php
require_once dirname(__DIR__) . "/utils/utils.php";
require_once dirname(__DIR__) . "/crud/crud_article.php";
require_once dirname(__DIR__) . "/crud/crud_user.php";

if (!isset($_SESSION)) {
          session_start();
}

function isAdmin(int $id) {
          $roles = getUserRoles($id);

          return in_array("admin", $roles["role"]);
}

function checkId($id) {
    if (empty($id)) 
        sendError(200, 'ID required');
}

function checkSelfDelete($id) {
          if ($id == $_SESSION['user']) {
                sendError(200,'Cannot delete yourself');
          }
}


?>