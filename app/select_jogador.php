<?php
$page_title = "Lista de Jogadores";
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../login/verifica_user.php';
include __DIR__ . '/../includes/header.php';
?>

<div class="page-header">
    <h1>🏃 Jogadores Cadastrados</h1>
</div>

<div class="card">
    <?php listar_jogadores($conexao); ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
