<?php
require_once __DIR__ . '/../database/conect.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }
session_destroy();

$redirect_url = defined('BASE_URL') ? BASE_URL . "login/login.php" : "../login/login.php";
header("Location: " . $redirect_url);
exit;
?>
