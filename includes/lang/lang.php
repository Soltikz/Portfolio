<?php
session_start();

// Définir la langue par défaut
$lang = 'fr';

// Vérifier si une langue est passée en paramètre d'URL
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
} elseif (isset($_SESSION['lang'])) {
    // Utiliser la langue de session si disponible
    $lang = $_SESSION['lang'];
}

// Charger le fichier de langue correspondant
$lang_file = __DIR__ . "/$lang.php";
if (file_exists($lang_file)) {
    $translations = include $lang_file;
} else {
    // Charger le fichier par défaut si la langue n'existe pas
    $translations = include __DIR__ . "/fr.php";
}