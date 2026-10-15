<?php
require_once __DIR__ . '/../includes/functions.php';

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (strlen($_POST['senha']) < 6) {
        $mensagem = "A senha precisa ter pelo menos 6 caracteres.";
    } else {
        try {
            cadastrar_user($conexao, trim($_POST['email']), $_POST['senha']);
            $mensagem = "Usuário cadastrado com sucesso! Já pode fazer login.";
        } catch (PDOException $e) {
            $mensagem = mensagem_erro_bd($e);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h1>COPA BOLOLÔ</h1>
    <h2>Cadastrar usuário</h2>
    <?php if ($mensagem): ?><p><strong><?= h($mensagem) ?></strong></p><?php endif; ?>

    <form action="" method="post">
        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" required><br>

        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha" required minlength="6"><br><br>

        <input type="submit" value="Cadastrar">
        <a href="login.php">Voltar para o login</a>
    </form>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
