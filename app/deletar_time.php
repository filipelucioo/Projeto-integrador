<?php
require_once __DIR__ . '/../login/verifica_user.php';
require_once __DIR__ . '/../includes/functions.php';

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $apagados = deletar_time($conexao, $_POST['id']);
        $mensagem = $apagados
            ? "Time " . (int) $_POST['id'] . " deletado."
            : "Nenhum time encontrado com esse ID.";
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
    <title>Deletar Time</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <h1>Deletar Time</h1>
    <p>Para apagar um time, primeiro apague (ou mude de time) os jogadores dele.</p>
    <?php if ($mensagem): ?><p><strong><?= h($mensagem) ?></strong></p><?php endif; ?>

    <form action="" method="post">
        <label for="id">ID: </label>
        <input type="number" name="id" id="id" required min="1" placeholder="Insira o ID do time">
        <input type="submit" value="Apagar" onclick="return confirm('Tem certeza que deseja apagar este time?');">
    </form>

    <h3>Times cadastrados</h3>
    <?php exibir_tabela_times(listar_times($conexao)); ?>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
