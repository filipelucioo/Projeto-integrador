<?php
require_once __DIR__ . '/../includes/functions.php';

// quem não está logado volta para o login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: " . BASE_URL . "login/login.php");
    exit;
}
