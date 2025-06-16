<?php

function getPages($directory)
{
  $pages = [];
  $files = scandir($directory);

  foreach ($files as $file) {
    if (str_contains($file, ".php")) {
      $filePath = $directory . '/' . $file;

      $content = file_get_contents($filePath);

      preg_match('/<h1>(.*?)<\/h1>/', $content, $matches) ? $title = $matches[1] : $title = "Sans titre";

      $pages[] = [
        'file' => $file,
        'title' => $title,
      ];
    }
  }

  return $pages;
}

$pages = getPages($_SERVER['DOCUMENT_ROOT']."/portfolio/public");