<?php
require_once __DIR__ . '/../login/verifica_user.php';
require_once __DIR__ . '/../includes/functions.php';

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $alterados = atualizar_time(
            $conexao,
            $_POST['id'],
            trim($_POST['nome']),
            trim($_POST['tecnico']),
            $_POST['cpf'],
            $_POST['nasc'],
            $_POST['telefone']
        );
        $mensagem = $alterados
            ? "Time atualizado com sucesso!"
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
    <title>Atualizar Time</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <h1>Atualizar Time</h1>
    <p>Escolha o time e preencha os novos dados (todos os campos são substituídos).</p>
    <?php if ($mensagem): ?><p><strong><?= h($mensagem) ?></strong></p><?php endif; ?>

    <form action="" method="post">
        <label for="id">Time: </label>
        <select name="id" id="id" required>
            <option value="">Selecione o time</option>
            <?php opcoes_times($conexao); ?>
        </select><br>

        <label for="nome">Nome do time: </label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="tecnico">Nome do técnico: </label>
        <input type="text" name="tecnico" id="tecnico" required><br>

        <label for="cpf">CPF do técnico: </label>
        <input type="text" name="cpf" id="cpf" required inputmode="numeric" pattern="\d{11}" maxlength="11" title="Digite os 11 números do CPF"><br>

        <label for="nasc">Data de nascimento: </label>
        <input type="date" name="nasc" id="nasc" required><br>

        <label for="telefone">Telefone: </label>
        <input type="text" name="telefone" id="telefone" required inputmode="numeric" pattern="\d{10,11}" maxlength="11" title="Digite DDD + número (10 ou 11 números)"><br><br>

        <input type="reset" value="Limpar">
        <input type="submit" value="Atualizar">
        <a href="../index.php">Voltar</a>
    </form>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
