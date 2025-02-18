<?php

function createSlug($text) {
          $text = preg_replace('~[^\pL\d]+~u', '-', $text);
          $text = trim($text, '-');
          $text = strtolower($text);
          $text = preg_replace('~[^-\w]+~', '', $text);
          if (empty($text)) {return 'n-a';}
          return $text;
}

?>