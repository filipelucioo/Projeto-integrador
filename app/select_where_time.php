<?php
require_once __DIR__ . '/../login/verifica_user.php';
require_once __DIR__ . '/../includes/functions.php';

$time = null;
$jogadores = [];
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $time = consultar_time($conexao, $_POST['id']);
    if ($time) {
        $jogadores = listar_jogadores_do_time($conexao, $time['id']);
    } else {
        $mensagem = "Nenhum time encontrado com esse ID.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Consultar Time</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <h1>Consultar um time</h1>
    <form action="" method="post">
        <label for="id">Time: </label>
        <select name="id" id="id" required>
            <option value="">Selecione o time</option>
            <?php opcoes_times($conexao, $_POST['id'] ?? null); ?>
        </select>
        <input type="submit" value="Consultar">
    </form>

    <?php if ($mensagem): ?><p><strong><?= h($mensagem) ?></strong></p><?php endif; ?>

    <?php if ($time): ?>
        <h3>Dados do time</h3>
        <?php exibir_tabela_times([$time]); ?>

        <h3>Jogadores do time</h3>
        <?php exibir_tabela_jogadores($jogadores); ?>
    <?php endif; ?>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
