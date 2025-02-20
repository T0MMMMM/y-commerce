<?php
require_once dirname(__DIR__) . "/utils/utils.php";
require_once dirname(__DIR__) . "/crud/crud_article.php";

function sendError($code, $message) {
        header('Content-Type: application/json');
          http_response_code($code);
          echo json_encode([
              "success" => false,
              "error" => $message
          ]);
          exit;
}

function sendSuccess($code, $message) {
    header('Content-Type: application/json');
          http_response_code($code);
          echo json_encode([
              "success" => true,
              "message" => $message
          ]);
          exit;
}

function createSlug($text) {
          $text = preg_replace('~[^\pL\d]+~u', '-', $text);
          $text = trim($text, '-');
          $text = strtolower($text);
          $text = preg_replace('~[^-\w]+~', '', $text);
          if (empty($text)) {return 'n-a';}
          return $text;
}

?>