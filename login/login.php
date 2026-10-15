<?php
require_once __DIR__ . '/../includes/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $usuario = consultar_user($conexao, trim($_POST['email']));

        if ($usuario && password_verify($_POST['senha'], $usuario['senha'])) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            header('Location: /Projeto-integrador/index.php');
            exit;
        }
        $mensagem = "E-mail ou senha incorretos.";
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
    <title>Página de Login</title>
</head>
<body>
    <h1>COPA BOLOLÔ</h1>
    <h2>Login</h2>
    <?php if ($mensagem): ?><p><strong><?= h($mensagem) ?></strong></p><?php endif; ?>

    <form action="" method="post">
        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" required><br>

        <label for="senha">Senha: </label>
        <input type="password" name="senha" id="senha" required><br><br>

        <input type="submit" value="Entrar">
    </form>

    <p>Ainda não tem conta? <a href="cadastrar.php">Cadastre-se</a></p>

    <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>
