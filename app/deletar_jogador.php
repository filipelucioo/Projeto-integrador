<?php
require_once __DIR__ . '/../login/verifica_user.php';
require_once __DIR__ . '/../includes/functions.php';

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $apagados = deletar_jogador($conexao, $_POST['id']);
        $mensagem = $apagados
            ? "Jogador " . (int) $_POST['id'] . " deletado."
            : "Nenhum jogador encontrado com esse ID.";
    } catch (PDOException $e) {
        $mensagem = mensagem_erro_bd($e);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Deletar Jogador</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <h1>Deletar Jogador</h1>
    <?php if ($mensagem): ?><p><strong><?= h($mensagem) ?></strong></p><?php endif; ?>

    <form action="" method="post">
        <label for="id">ID: </label>
        <input type="number" name="id" id="id" required min="1" placeholder="Insira o ID do jogador">
        <input type="submit" value="Apagar" onclick="return confirm('Tem certeza que deseja apagar este jogador?');">
    </form>

    <h3>Jogadores cadastrados</h3>
    <?php exibir_tabela_jogadores(listar_jogadores($conexao)); ?>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
