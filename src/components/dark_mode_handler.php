<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_dark_mode'])) {
    $currentDarkMode = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1';
    $newValue = $currentDarkMode ? '0' : '1';
    setcookie('dark_mode', $newValue, time() + 86400 * 365, '/');
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

$darkMode = isset($_COOKIE['dark_mode']) && $_COOKIE['dark_mode'] === '1';