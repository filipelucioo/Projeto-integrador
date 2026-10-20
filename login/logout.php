<?php
require_once __DIR__ . '/../database/conect.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }
session_destroy();

header("Location: " . BASE_URL . "login/login.php");
exit;
?>
