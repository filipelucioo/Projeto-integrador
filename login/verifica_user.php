<?php
// Inclua este arquivo no TOPO das páginas que exigem login.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['usuario_id'])) {
    header('Location: /Projeto-integrador/login/login.php');
    exit;
}
