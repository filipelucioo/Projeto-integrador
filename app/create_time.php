<?php
require_once __DIR__ . '/../login/verifica_user.php';
require_once __DIR__ . '/../includes/functions.php';

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        cadastrar_time(
            $conexao,
            trim($_POST['nome']),
            trim($_POST['tecnico']),
            $_POST['cpf'],
            $_POST['nasc'],
            $_POST['telefone']
        );
        $mensagem = "Time cadastrado com sucesso!";
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
    <title>Cadastrar Time</title>
</head>
<body>
    <?php include __DIR__ . '/../includes/header.php'; ?>

    <h1>Cadastrar Time</h1>
    <hr>
    <?php if ($mensagem): ?><p><strong><?= h($mensagem) ?></strong></p><?php endif; ?>

    <form action="" method="POST">
        <label for="nome">Nome do time: </label>
        <input type="text" name="nome" id="nome" required placeholder="Insira o nome do time"><br>

        <label for="tecnico">Nome do técnico: </label>
        <input type="text" name="tecnico" id="tecnico" required placeholder="Insira o nome do técnico"><br>

        <label for="cpf">CPF do técnico: </label>
        <input type="text" name="cpf" id="cpf" required placeholder="Somente números" inputmode="numeric" pattern="\d{11}" maxlength="11" title="Digite os 11 números do CPF"><br>

        <label for="nasc">Data de nascimento: </label>
        <input type="date" name="nasc" id="nasc" required><br>

        <label for="telefone">Telefone: </label>
        <input type="text" name="telefone" id="telefone" required placeholder="DDD + número" inputmode="numeric" pattern="\d{10,11}" maxlength="11" title="Digite DDD + número (10 ou 11 números)"><br><br>

        <input type="reset" value="Limpar">
        <input type="submit" value="Enviar">
        <a href="../index.php">Voltar</a>
        <a href="create_jogador.php">Cadastrar jogador</a>
    </form>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
