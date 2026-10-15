<?php
require_once __DIR__ . '/../login/verifica_user.php';
require_once __DIR__ . '/../includes/functions.php';

$jogador = null;
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $jogador = consultar_jogador($conexao, $_POST['id']);
    if (!$jogador) {
        $mensagem = "Nenhum jogador encontrado com esse ID.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Consultar Jogador</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <h1>Consultar um jogador</h1>
    <form action="" method="post">
        <label for="id">ID do jogador: </label>
        <input type="number" name="id" id="id" required min="1">
        <input type="submit" value="Consultar">
    </form>

    <?php if ($mensagem): ?><p><strong><?= h($mensagem) ?></strong></p><?php endif; ?>

    <?php if ($jogador): ?>
        <?php exibir_tabela_jogadores([$jogador]); ?>
    <?php endif; ?>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
