<?php
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

require_once __DIR__ . '/../database/conect.php';

// Fallback de segurança se BASE_URL não estiver definida
if (!defined('BASE_URL')) {
    $script_name = $_SERVER['SCRIPT_NAME'] ?? '';
    $base = preg_replace('#/(app|login|includes|database).*$#i', '', $script_name);
    if (substr($base, -1) !== '/') {
        $base .= '/';
    }
    define('BASE_URL', $base);
}

if (!isset($_SESSION['usuario_id'])) {
    $redirect_url = defined('BASE_URL') ? BASE_URL . "login/login.php" : "../login/login.php";
    header("Location: " . $redirect_url);
    exit;
}
?>
