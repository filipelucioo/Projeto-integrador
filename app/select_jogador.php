<?php
require_once __DIR__ . '/../login/verifica_user.php';
require_once __DIR__ . '/../includes/functions.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Lista de Jogadores</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <h1>Lista completa de jogadores</h1>
    <?php exibir_tabela_jogadores(listar_jogadores($conexao)); ?>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
