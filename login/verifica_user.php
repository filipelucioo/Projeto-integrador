<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once __DIR__ . '/../database/conect.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: " . BASE_URL . "login/login.php");
    exit;
}
?>
