<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../database/conect.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' | Copa Bololô' : 'Copa Bololô - Campeonato Amador' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<header class="main-header">
    <div class="header-container">
        <a href="<?= BASE_URL ?>index.php" class="logo-brand">
            <span class="logo-icon">⚽</span>
            <span class="logo-text">COPA <strong>BOLOLÔ</strong></span>
        </a>
        <nav class="main-nav">
            <a href="<?= BASE_URL ?>index.php">Início</a>
            <a href="<?= BASE_URL ?>tabela.php">Tabela</a>
            <a href="<?= BASE_URL ?>artilharia.php">Artilharia</a>
            
            <div class="dropdown">
                <button class="dropbtn">Times ▾</button>
                <div class="dropdown-content">
                    <a href="<?= BASE_URL ?>app/create_time.php">Cadastrar Time</a>
                    <a href="<?= BASE_URL ?>app/select_time.php">Listar Times</a>
                    <a href="<?= BASE_URL ?>app/select_where_time.php">Consultar Time</a>
                    <a href="<?= BASE_URL ?>app/update_time.php">Atualizar Time</a>
                    <a href="<?= BASE_URL ?>app/deletar_time.php">Deletar Time</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropbtn">Jogadores ▾</button>
                <div class="dropdown-content">
                    <a href="<?= BASE_URL ?>app/create_jogador.php">Cadastrar Jogador</a>
                    <a href="<?= BASE_URL ?>app/select_jogador.php">Listar Jogadores</a>
                    <a href="<?= BASE_URL ?>app/select_where_jogador.php">Consultar Jogador</a>
                    <a href="<?= BASE_URL ?>app/update_jogador.php">Atualizar Jogador</a>
                    <a href="<?= BASE_URL ?>app/deletar_jogador.php">Deletar Jogador</a>
                </div>
            </div>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="<?= BASE_URL ?>login/logout.php" class="btn-logout">Sair</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>login/login.php" class="btn-login">Área Restrita</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="main-container">
