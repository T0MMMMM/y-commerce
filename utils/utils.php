<?php

function createSlug($text) {
          // Remplace les caractères non alphanumériques par des tirets
          $text = preg_replace('~[^\pL\d]+~u', '-', $text);

          // Supprime les tirets en début et fin de chaîne
          $text = trim($text, '-');

          // Convertit en minuscules
          $text = strtolower($text);

          // Supprime les caractères non désirés
          $text = preg_replace('~[^-\w]+~', '', $text);

          if (empty($text)) {
                    return 'n-a';
          }

          return $text;
}

?>